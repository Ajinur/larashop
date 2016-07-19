<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSettings;
use App\Http\Requests;
use DB;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('webAuth');
    }

    public function getSettings()
    {
    	$data = SystemSettings::find(1);
        $orderStatus = DB::table('transaction_status')->pluck('name', 'id');
        $processingOrderStatus = DB::table('transaction_status')->pluck('name', 'id');
        $completeOrderStatus = DB::table('transaction_status')->pluck('name', 'id');
    	return view('admin.system.settings.index', compact('data', 'orderStatus', 'processingOrderStatus', 'completeOrderStatus'));
    }

    public function updateSettings(Request $request, $id)
    {
    	$rules = [
    			  'store_name' => 'required', 
    			  'store_owner' => 'required',
    			  'store_url' => 'required|url', 
    			  'address' => 'required',
    			  'email' => 'required', 
    			  'phone' => 'required',
    			  'meta_title' => 'required', 
    			 ];

    	$this->validate($request, $rules);
    	$systemsettings = SystemSettings::find(1);
    	$systemsettings->update($request->all());

    	if($request->hasFile('logo'))
    	{
    		$upload = $request->logo;

            $extension = $upload->getClientOriginalExtension();

            $filename = $upload->getClientOriginalName();
            $destinationPath = 'assets/backend/images/logo/';

            $upload->move($destinationPath, $filename);

            $systemsettings->logo = $filename;
            $systemsettings->save();
    	}

    	return redirect('admin/system/settings')->with('successMessage', 'System Settings Updated');
    }
}
