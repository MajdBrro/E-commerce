<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(){

        return view('dashboard.auth.login');

    }


    public function checkAdminLogin(AdminLoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$remember_me)){

            return redirect()->intended('admin/dashboard')->with(['success' => 'تم الدخول بنجاح']);
        }
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
    public function logout(){
        // $guard = $this -> getGuard();
        // $guard -> logout();
        Auth::Logout('admin');
        return redirect()-> route('admin.login');
    }

}
