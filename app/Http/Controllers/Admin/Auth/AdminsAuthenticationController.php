<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Auth;

class AdminsAuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }


    public function login(){
        return view('admin.admin_login');
    }

    public function postLogin(Request $request){

        $data = $request->all();
        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ];
        $customMessages = [
            'email.required' => 'Email is required',
            'email.email' => 'Valid email is required',
            'password.required' => 'Password is required'
        ];

        $this->validate($request,$rules,$customMessages);

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if(Auth::guard('admin')->attempt($credentials, ($request->rememberMe == 'on') ? true : false)){
            return redirect()->route('admin.dashboard');
        }else{
            Session::flash('error_message','Invalid email or password');
            return redirect()->route('admin.login');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
