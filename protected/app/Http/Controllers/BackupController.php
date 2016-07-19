<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('webAuth');
    }

    public function index()
    {
    	return view('admin.backup');
    }

    public function backup()
    {
    	\Artisan::call('backup:clean');
    	\Artisan::call('backup:run');
   		return Redirect::route('backup')->with('infoMessage', 'Database berhasil di Backup');
    }

    public function listBackup()
    {
        $list = \Artisan::call('backup:list');
        return $list;
    }
}
