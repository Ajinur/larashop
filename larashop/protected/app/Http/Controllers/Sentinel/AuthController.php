<?php



namespace App\Http\Controllers\Sentinel;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Sentinel, Redirect;



class AuthController extends Controller

{

	public $redirectTo = 'admin/login';

    public function authenticate(Request $request) {

    	$rules = [

    		'user'		=> 'required',

    		'password'	=> 'required',

    	];

    	$this->validate($request, $rules);



    	$credentials = [

    		'login'		=> $request->input('user'),

    		'password'	=> $request->input('password'),

    	];



    	try {

	        $user = Sentinel::authenticate($credentials, false);

	        if ($user) {

                return redirect('admin/home')->with('successMessage', 'Selamat Datang');

	        } else {

	        	return Redirect::back()->with('errorMessage','Username atau Password Anda Salah.')->withInput();

	        }

		} /*catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {

	        return Redirect::back()->with('errorMessage','Suspicious activity has occured on your IP address and you have been denied access for another [397] second(s)');

	    } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {

	        return Redirect::back()->with('warningMessage','Your Account is not activated!');

	    }*/ catch (Exception $e) {

	        return $e;

	    }

    }

    public function logout() {

        Sentinel::logout(null, true);

        return redirect($this->redirectTo);

    }

}

