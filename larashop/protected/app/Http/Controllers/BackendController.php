<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tags;
use App\Models\Brands;
use App\Models\Information;
use App\Models\Customer;
use App\Http\Requests;
use URL, Yajra\Datatables\Datatables, Redirect, Html, DB, Carbon\Carbon;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('webAuth');
    }

    public function getCategories()
    {
    	return view('admin.categories.index');

    }

    public function getCategoriesData()
    {
    	$category = Category::with('sub_cat')->select()->orderBy('category_name', 'asc');

        return Datatables::of($category)
            ->addColumn('action', function ($ctg) {
                return '
                        <a href="'. URL::route('categories.edit', $ctg->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createCategories()
    {
    	$parent = Category::pluck('category_name', 'id');
    	return view('admin.categories.create', compact('parent'));
    }

    public function editCategories($id)
    {
    	$data = Category::FindOrFail($id);
    	$parent = Category::pluck('category_name', 'id');
    	return view('admin.categories.edit', compact('data', 'parent'));
    }

    public function storeCategories(Request $request)
    {
    	$rules = ['category_name' => 'required', 'meta_title' => 'required'];

    	$this->validate($request, $rules);
    	$categories = Category::create($request->all());

    	if($request->hasFile('meta_image'))
    	{
    		$upload = $request->meta_image;

            $extension = $upload->getClientOriginalExtension();

            $filename = $upload->getClientOriginalName();
            $destinationPath = 'assets/backend/images/categories/';

            $upload->move($destinationPath, $filename);

            $categories->meta_image = $filename;
            $categories->save();
    	}

    	return redirect('admin/categories')->with('successMessage', 'Category Created');
    }

    public function updateCategories(Request $request, $id)
    {
    	$rules = [
    			  'category_name' => 'required|unique:category,category_name,'.$id.',id', 
    			  'meta_title' => 'required'
    			 ];

    	$this->validate($request, $rules);
    	$categories = Category::find($id);
    	$categories->update($request->all());

    	if($request->hasFile('meta_image'))
    	{
    		$upload = $request->meta_image;

            $extension = $upload->getClientOriginalExtension();

            $filename = $upload->getClientOriginalName();
            $destinationPath = 'assets/backend/images/categories/';

            $upload->move($destinationPath, $filename);

            $categories->meta_image = $filename;
            $categories->save();
    	}

    	return redirect('admin/categories')->with('successMessage', 'Category Updated');
    }

    public function deleteCategories($id)
    {

    }

    /*************************************************Product***********************************************/

    public function getProducts()
    {
        return view('admin.products.index');
    }

    public function getProductsData()
    {
        $category = Product::with('brand', 'category')->select();
        
        return Datatables::of($category)
            ->addColumn('action', function ($ctg) {
                return '
                        <a href="'. URL::route('products.edit', $ctg->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('image', function($product) {
                
                return Html::image('assets/frontend/images/products/' . $product->image, $product->name, ['width' => '70px', 'height' => '40px']);
                
            })
            ->editColumn('status', function($product) {
                
                if($product->status == 'A')
                {
                    return '<span class="label label-primary">Enabled</span>';
                }
                else
                {
                    return '<span class="label label-danger">Disabled</span>';
                }
                
            })
            ->editColumn('quantity', function($product) {
                
                if($product->quantity == 0)
                {
                    return '<span class="label label-warning">'.$product->quantity.'</span>';
                }
                else
                {
                    return '<span class="label label-info">'.$product->quantity.'</span>';
                }
                
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createProducts()
    {
        $category = Category::pluck('category_name', 'id');
        $brand  = Brands::pluck('brand_name', 'id');
        $length = DB::table('length_type')->pluck('length_name', 'id');
        $weight = DB::table('weight_type')->pluck('weight_name', 'id');
        $tags   = Tags::select('*', DB::raw("'0' as checked"))->get();
        return view('admin.products.create', compact('category', 'brand', 'length', 'weight', 'tags'));
    }

    public function editProducts($id)
    {
        $data = Product::FindOrFail($id);
        $category = Category::pluck('category_name', 'id');
        $brand = Brands::pluck('brand_name', 'id');
        $length = DB::table('length_type')->pluck('length_name', 'id');
        $weight = DB::table('weight_type')->pluck('weight_name', 'id');
        $tags   = Tags::select('*', DB::raw("'0' as checked"))->get();

        foreach ($tags as $tag => $value) {
            $cek = DB::table('product_tags')
                ->where('product_id', '=', $id)
                ->where('tags_id', '=', $value->id)
                ->count();

            if ($cek) {
                $value->checked = 'checked';
            }
        }

        return view('admin.products.edit', compact('data', 'category', 'brand', 'length', 'weight', 'tags'));
    }

    public function storeProducts(Request $request)
    {
        $rules = [
        'name' => 'required|unique:products,name', 
        'meta_title' => 'required',
        'meta_description' => 'max:255',
        'meta_keyword' => 'max:255',
        'model' => 'required|unique:products,model',
        'brand_id' => 'required',
        'quantity' => 'numeric',
        'weight' => 'numeric', 
        'category_id' => 'required',
        'tags' => 'required'
        ];

        $this->validate($request, $rules);

        $tags = $request->tags;

        DB::beginTransaction();
        try
        {
            $products = Product::create($request->except('tags'));
            $products->product_tags()->sync($tags);

            if($request->hasFile('meta_image'))
            {
                $upload = $request->meta_image;

                $extension = $upload->getClientOriginalExtension();

                $filename = $upload->getClientOriginalName();
                $destinationPath = 'assets/frontend/images/products/';

                $upload->move($destinationPath, $filename);

                $products->meta_image = $filename;
                $products->save();
            }
        }
        catch (Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->with('errorMessage', 'Terjadi kesalahan input.'); 
        }
        
        DB::commit();
        return redirect('admin/products')->with('successMessage', 'Product Created');
    }

    public function updateProducts(Request $request, $id)
    {
        $rules = [
                  'name' => 'required|unique:products,name,'.$id.',id', 
                  'meta_title' => 'required',
                  'meta_description' => 'max:255',
                  'meta_keyword' => 'max:255',
                  'model' => 'required|unique:products,model,'.$id.',id', 
                  'brand_id' => 'required', 
                  'category_id' => 'required',
                  'quantity' => 'numeric',
                  'weight' => 'numeric', 
                  'tags' => 'required'
                 ];

        $this->validate($request, $rules);

        $tags = (array) $request->tags;

        DB::beginTransaction();
        try
        {
            $products = Product::find($id);
            $products->update($request->except('tags'));
            $products->product_tags()->sync($tags);

            if($request->hasFile('image'))
            {
                $upload = $request->image;

                $extension = $upload->getClientOriginalExtension();

                $filename = $upload->getClientOriginalName();
                $destinationPath = 'assets/frontend/images/products/';

                $upload->move($destinationPath, $filename);

                $products->image = $filename;
                $products->save();
            }
        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('errorMessage', 'Terjadi kesalahan input.');
        }
        
        DB::commit();
        return redirect('admin/products')->with('successMessage', 'Product Updated');
    }

    public function deleteProducts($id)
    {

    }

    /*************************************************Tags***********************************************/

    public function getTags()
    {
        return view('admin.tags.index');
    }

    public function getTagsData()
    {
        $tags = Tags::select(['id', 'tag']);

        return Datatables::of($tags)
            ->addColumn('action', function ($ctg) {
                return '
                        <a href="'. URL::route('tags.edit', $ctg->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createTags()
    {
        return view('admin.tags.create');
    }

    public function editTags($id)
    {
        $data = Tags::FindOrFail($id);
        return view('admin.tags.edit', compact('data'));
    }

    public function storeTags(Request $request)
    {
        $rules = ['tag' => 'required|unique:tags,tag'];

        $this->validate($request, $rules);
        $tags = Tags::create($request->all());

        return redirect('admin/tags')->with('successMessage', 'Tag Created');
    }

    public function updateTags(Request $request, $id)
    {
        $rules = [
                  'tag' => 'required|unique:category,tag,'.$id.',id' 
                 ];

        $this->validate($request, $rules);
        $tags = Tags::find($id);
        $tags->update($request->all());

        return redirect('admin/tags')->with('successMessage', 'Tag Updated');
    }

    public function deleteTags($id)
    {

    }

    /*************************************************Review***********************************************/

    public function getReview()
    {
        return view('admin.review.index');
    }

    public function getReviewData()
    {
        $review = DB::table('testimoni')
                  ->join('products', 'testimoni.product_id', '=', 'products.id')
                  ->select(['testimoni.id', 'products.name', 'testimoni.name as author', 'testimoni.rating', 
                            'testimoni.status', 'testimoni.testimoni_date']);

        return Datatables::of($review)
            ->addColumn('action', function ($rev) {
                return '
                        <a href="'. URL::route('review.approved', $rev->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Make Approved</a>';
            })
            ->editColumn('testimoni_date', function ($testimoni) {
                return $testimoni->testimoni_date ? with(new Carbon($testimoni->testimoni_date))->format('d/M/Y') : '';
            })
            ->editColumn('status', function($status) {
                
                if($status->status == 0)
                {
                    return '<span class="label label-warning">Disabled</span>';
                }
                else
                {
                    return '<span class="label label-info">Enabled</span>';
                }
                
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function makeApproved($id)
    {
        DB::table('testimoni')->where('id', $id)->update(['status' => 1]);
        return Redirect::route('review')->with('successMessage', 'Review Approved.');
    }

    public function deleteReview($id)
    {

    }

    /*************************************************Informations***********************************************/

    public function getInformation()
    {
        return view('admin.information.index');
    }

    public function getInformationData()
    {
        $info = Information::select(['id', 'title', 'order']);

        return Datatables::of($info)
            ->addColumn('action', function ($information) {
                return '
                        <a href="'. URL::route('information.edit', $information->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createInformation()
    {
        return view('admin.information.create');
    }

    public function editInformation($id)
    {
        $data = Information::FindOrFail($id);
        return view('admin.information.edit', compact('data'));
    }

    public function storeInformation(Request $request)
    {
        $rules = ['title' => 'required|unique:information,title', 'meta_title' => 'required'];

        $this->validate($request, $rules);
        $information = Information::create($request->all());

        return redirect('admin/information')->with('successMessage', 'Information Created');
    }

    public function updateInformation(Request $request, $id)
    {
        $rules = [
                  'title' => 'required|unique:informations,title,'.$id.',id', 
                  'meta_title' => 'required'
                 ];

        $this->validate($request, $rules);
        $information = Information::find($id);
        $information->update($request->all());

        return redirect('admin/information')->with('successMessage', 'Information Updated');
    }

    public function deleteInformation($id)
    {

    }

    /*************************************************Customers***********************************************/

    public function getCustomers()
    {
        return view('admin.customers.index');
    }

    public function getCustomersData()
    {
        $customer = Customer::join('customer_group', 'customer.customer_group', '=', 'customer_group.id')
                ->select(['customer.*', 'customer_group.customer_group_name']);

        return Datatables::of($customer)
            ->addColumn('action', function ($cus) {
                return '
                        <a href="'. URL::route('customers.edit', $cus->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createCustomers()
    {
        $customergroup = DB::table('customer_group')->pluck('customer_group_name', 'id');
        $kota = DB::table('regencies')->pluck('name', 'id');
        $provinsi = DB::table('provinces')->pluck('name', 'id');
        return view('admin.customers.create', compact('customergroup', 'kota', 'provinsi'));
    }

    public function editCustomers($id)
    {
        $data = Customer::FindOrFail($id);
        $customergroup = DB::table('customer_group')->pluck('customer_group_name', 'id');
        $kota = DB::table('regencies')->pluck('name', 'id');
        $provinsi = DB::table('provinces')->pluck('name', 'id');
        return view('admin.customers.edit', compact('data', 'customergroup', 'kota', 'provinsi'));
    }

    public function storeCustomers(Request $request)
    {
        $rules = [
            'nama' => 'required|max:20|alpha|unique:customer,nama', 
            'email' => 'required|email|unique:customer,email',
            'alamat' => 'required|max:50',
            'telepon' => 'required|numeric',
            'provinsi' => 'required',
            'kota' => 'required'
        ];

        $this->validate($request, $rules);
        $customers = Customer::create($request->all());

        return redirect('admin/customers')->with('successMessage', 'Customer Created');
    }

    public function updateCustomers(Request $request, $id)
    {
        $rules = [
                 'nama' => 'required|max:20|alpha|unique:customer,nama,'.$id.',id', 
                 'email' => 'required|email|unique:customer,email,'.$id.',id',
                 'alamat' => 'required|max:50',
                 'telepon' => 'required|numeric',
                 'provinsi' => 'required',
                 'kota' => 'required'
                 ];

        $this->validate($request, $rules);
        $customers = Customer::find($id);
        $customers->update($request->all());

        return redirect('admin/customers')->with('successMessage', 'Customer Updated');
    }

    public function deleteCustomers($id)
    {

    }

    /*************************************************Customer Groups***********************************************/

    public function getCustomerGroups()
    {
        return view('admin.customergroups.index');
    }

    public function getCustomerGroupsData()
    {
        $customergroup = DB::table('customer_group')->select(['id', 'customer_group_name']);

        return Datatables::of($customergroup)
            ->addColumn('action', function ($cusgr) {
                return '
                        <a href="'. URL::route('customergroups.edit', $cusgr->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function createCustomerGroups()
    {
        return view('admin.customergroups.create');
    }

    public function editCustomerGroups($id)
    {
        $data = DB::table('customer_group')->where('id', $id)->first();
        return view('admin.customergroups.edit', compact('data'));
    }

    public function storeCustomerGroups(Request $request)
    {
        $rules = [
            'customer_group_name' => 'required|max:20|alpha|unique:customer_group,customer_group_name', 
        ];

        $this->validate($request, $rules);
        $customergroups = DB::table('customer_group')->insert($request->except('_token'));

        return redirect('admin/customergroups')->with('successMessage', 'Customer Group Created');
    }

    public function updateCustomerGroups(Request $request, $id)
    {
        $rules = [
                 'customer_group_name' => 'required|max:20|alpha|unique:customer_group,customer_group_name,'.$id.',id', 
                 ];

        $this->validate($request, $rules);
        $customergroups = DB::table('customer_group')->where('id', $id)->update($request->except('_token'));

        return redirect('admin/customergroups')->with('successMessage', 'Customer Group Updated');
    }

    public function deleteCustomerGroups($id)
    {

    }
}
