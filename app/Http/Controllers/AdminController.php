<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentials,$request->remember)){
            return redirect()->route('admin.home');
        }
        return redirect()->route('admin.login')->with('status','Failed to login');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        if($this->guard() == 'admin'){
                $request->session()->invalidate();
                $request->session()->regenerateToken();
        }
        return redirect()->route('admin.login')->with('status','Logout Successfully..');
    }
    public function guard()
    {
        return Auth::guard('admin');
    }
    
}
