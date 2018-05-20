<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Mail\AdminResetPassword;
use App\Admin;
class AdminAuthController extends Controller
{
    //
    public function login(){
    	return view('admin.auth.login');
    }
    public function doLogin(){
    	$rememberme = request('rememberme')==1?true:false;
    	if(auth()->guard('admin')->attempt(['email'=>request('email'),'password'=>request('password')],$rememberme)){
    		return redirect('admin');
    	}else{

    		session()->flash('error',trans('admin.error_login'));
    		return redirect('admin/login');
    	}
    }
    public function logout(){
    	auth()->guard('admin')->logout();
    	return redirect('admin/login');
    }
    public function forgot_password(){
    	return view('admin.auth.forgot');
    }
    public function forgot_password_post() {
    	$admin = Admin::where('email',request('email'))->first();
    	if(($admin)){
    		
    		$token = app('auth.password.broker')->createToken($admin);
    		$data  = DB::table('password_resets')->insert([
    			'email'=>request('email'),
    			'token'=>$token,
    			'created_at'=>Carbon::now(),
    		]);
    		return new AdminResetPassword(['data'=>$admin,'token'=>$token]);
    	}
    	return back();
    }
}
