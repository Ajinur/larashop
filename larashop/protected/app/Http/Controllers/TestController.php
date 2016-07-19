<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;

use App\Http\Requests;

class TestController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
    	return $dataTable->render('test');
    }
}
