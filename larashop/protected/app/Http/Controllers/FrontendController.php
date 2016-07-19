<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Testimoni;
use App\Models\Information;
use App\Models\Category;
use App\Models\Brands;
use Input, Redirect, Cart, Carbon\Carbon, Mail, DB, Sentinel;
use App\Http\Requests;

class FrontendController extends Controller
{
    public function index()
    {
    	$product = Product::orderBy('id', 'desc')->paginate(12);
    	return view('dashboard', compact('product'));
    }

    public function detailProduct($slug)
    {
    	$product  = Product::with('brand', 'category')->where('slug', $slug)->first();
        $terlaris = Product::orderBy('sold', 'desc')->paginate(3);
        $testimoni = Testimoni::where('product_id', $product->id)->where('status', 1)->get();
        $cnt = Testimoni::where('product_id', $product->id)->where('status', 1)->count();
         
    	return view('frontend.detailproduct', compact('product', 'terlaris', 'testimoni', 'cnt', 'jam', 'tgl'));
    }

    public function detailCategory($slug)
    {
        $categoryId = Category::where('slug', $slug)->value('id');
        $category   = ucfirst($slug);
        $title    = "$category";
        $product  = Product::join('category', 'products.category_id', '=', 'category.id')
                    ->leftJoin('testimoni', 'products.id', '=', 'testimoni.product_id')
                    ->select('products.*', 'testimoni.rating')
                    ->where('products.category_id', $categoryId);
        
        $shortby   = [
            'name_asc' => 'Name (A - Z)',
            'name_desc' => 'Name (Z - A)',
            'price_asc' => 'Price (Low > High)',
            'price_desc' => 'Price (High > Low)',
            'rating_highest' => 'Rating (Highest)',
            'rating_lowest' => 'Rating (Lowest)',
            'model_asc' => 'Model (A - Z)',
            'model_desc' => 'Model (Z - A)',
        ];

        $show     = [1 => '1', '15' => '15', '25' => '25', '50' => '50', '75' => '75', '100' => '100'];

        if(Input::get('shortby') == 'name_asc') $product->orderBy('products.name', 'asc');
        if(Input::get('shortby') == 'name_desc') $product->orderBy('products.name', 'desc');
        if(Input::get('shortby') == 'price_asc') $product->orderBy('price', 'asc');
        if(Input::get('shortby') == 'price_desc') $product->orderBy('price', 'desc');
        if(Input::get('shortby') == 'rating_highest') $product->orderBy('testimoni.rating', 'desc');
        if(Input::get('shortby') == 'rating_lowest') $product->orderBy('testimoni.rating', 'asc');
        if(Input::get('shortby') == 'model_asc') $product->orderBy('model', 'asc');
        if(Input::get('shortby') == 'model_desc') $product->orderBy('model', 'desc');

        if(Input::get('show') == 1) $product->paginate(1);
        if(Input::get('show') == '15') $product->paginate(15);
        if(Input::get('show') == '25') $product->paginate(25);
        if(Input::get('show') == '50') $product->paginate(50);
        if(Input::get('show') == '75') $product->paginate(75);
        if(Input::get('show') == '100') $product->paginate(100);

        $data = $product->paginate(12);

        return view('frontend.detailcategory', compact('data', 'title', 'shortby', 'show', 'slug'));
    }

    public function detailBrand($slug)
    {
        $brandId = Brands::where('slug', $slug)->value('id');
        $brand   = ucfirst($slug);
        $product = Product::with('brand')->where('brand_id', $brandId)->paginate(12);
        $title   = "$brand"; 
        return view('frontend.detailbrand', compact('product', 'title'));
    }

    public function detailInformation($slug)
    {
        $info = Information::where('slug', $slug)->first();
        return view('frontend.detailinfo', compact('info'));
    }

    public function filterPrice(Request $request)
    {
        $arr = explode(',', $request->price);
        
        $product = Product::where('price', '>', $arr[0])
                          ->where('price', '<', $arr[1])  
                          ->get();
        return $product;
        return view('frontend.filter', compact('product'));
    }

    public function addtoCart(Request $request)
    {
        $product = Product::find($request->id);
        
        $data    = array(
            'id' => $request->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $request->qty,
            'image' => $product->image,
            'sold' => $product->sold,
            'slug' => $product->slug,
            'total' => $request->qty * $product->price
        );

        Cart::add($data);
        $cart_content = Cart::content();
        return view('frontend.cart', compact('cart_content', 'data'));
    }

    public function deleteCart($id)
    {
        Cart::remove($id);
        $cart_content = Cart::content();

        if(Cart::count() == 0)
        {
            return redirect('')->with('infoMessage', 'Batal Transaksi');
        }
        else
        {
            return redirect('cart')->with('cart_content', $cart_content);
        }
    }

    public function cart()
    {
        $cart_content = Cart::content();
        return view('frontend.cart', compact('cart_content'));
    }

    public function auto_po_no()
    {
        $code   = Transaction::select(DB::raw('max(invoice) as code'))->get();
        foreach ($code as $key) 
        {
            $kode = substr($key->code, 3,3);
        }

        $plus = $kode+1;
        if($plus < 10)

        {

            $id = "IN000".$plus;
        }
        else
        {

            $id = "IN00".$plus;
        }
        return $id;
    }

    public function checkout()
    {
        
        $invoice = $this->auto_po_no();
        $provinsi = DB::table('provinces')->pluck('name', 'id');
        $cart_content = Cart::content();

        $trans = Transaction::create([
                        'invoice' => $invoice, 
                        'tanggal' => Carbon::now()->format('Y-m-d'),
                        'status' => 'Pending',
                        'subtotal' => Cart::total(),
                        'type' => 'Guest' 
                     ]);

        foreach ($cart_content as $cart) 
        {
            
            $detail = DB::table('transaction_detail')->insert([
                'trans_id' => $trans->id,
                'invoice' => $invoice,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'subtotal' => Cart::total()
            ]);

        }

        Cart::destroy();
        
        return view('frontend.register')->with('invoice', $invoice)->with('provinsi', $provinsi);

    }

    public function storeCustomer(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required',
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);
        Customer::create($request->all());

        $invoice  = $request->invoice;

        $trans        = Transaction::where('invoice', $invoice)->first();

        $transaction  = Transaction::join('transaction_detail', 'transactions.invoice', '=', 'transaction_detail.invoice')
                        ->leftJoin('products', 'transaction_detail.product_id', '=', 'products.id')
                        ->select('products.name', 'transaction_detail.price', 'transaction_detail.qty', 'transaction_detail.subtotal')
                        ->where('transactions.invoice', $invoice)->get();

        $customer = Customer::where('invoice', $invoice)->first();
        $provinsi = DB::table('provinces')->where('id', $customer->provinsi)->value('name');
        return view('frontend.invoice', compact('trans', 'transaction', 'customer', 'provinsi'));
    }

    public function storeReview(Request $request)
    {
        $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'testimoni' => 'required|min:25|max:1000',
        'rating' => 'required'
        ];

        $this->validate($request, $rules);
        $review = Testimoni::create($request->all());

        return Redirect::back()->with('infoMessage', 'Thank you for your review. It has been submitted to the webmaster for approval.');
        
    }

    
}
