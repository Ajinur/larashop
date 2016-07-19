<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use URL, Yajra\Datatables\Datatables, Redirect, Html, DB, Carbon\Carbon;
use App\Http\Requests;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('webAuth');
    }

    public function index()
    {
    	return view('admin.orders.index');
    }

    public function data()
    {
    	$order = Transaction::join('customer', 'transactions.formid', '=', 'customer.formid')	
    						  ->select(['transactions.*', 'customer.nama as customer']);

    	return Datatables::of($order)
            ->addColumn('action', function ($orders) {
                if($orders->status == 'Pending')
                {
                    return '
                        <a href="'. URL::route('orders.view', $orders->id) .'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>

                        <a href="'. URL::route('orders.process', $orders->id) .'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Make Completed</a>';
                }
                else
                {
                    return '
                        <a href="'. URL::route('orders.view', $orders->id) .'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye"></i> View</a>';
                }
                
            })
            ->editColumn('status', function($c) {
                
                if($c->status == 'Pending')
                {
                    return '<span class="label label-warning">'.$c->status.'</span>';
                }
                else
                {
                    return '<span class="label label-success">'.$c->status.'</span>';
                }
                
            })
            ->editColumn('subtotal', function ($a) {
                return number_format($a->subtotal, 2);
            })
            ->editColumn('tanggal', function ($q) {
                return Carbon::parse($q->tanggal)->format('d/m/Y');
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function view($id)
    {
    	$orders = Transaction::join('products', 'transactions.product_id', '=', 'products.id')
    			  			   ->where('transactions.id', $id)
    						   ->select('transactions.*', 'products.name as products')
    						   ->get();
    	
    	$orderInfo = Transaction::join('customer', 'transactions.formid', '=', 'customer.formid')
    			  			   ->where('transactions.id', $id)
    						   ->select('transactions.*', 'customer.nama as customer')
    						   ->first();

    	return view('admin.orders.view', compact('orders', 'orderInfo'));
    }

    public function makeProcess($id)
    {
        Transaction::findOrFail($id)->update(['status' => 'Complete']);
        return Redirect::route('orders')->with('successMessage', 'Order Completed.');
    }
}
