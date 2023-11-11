<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;

//use App\A0057;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['logout', 'showLoginForm', 'authenticate']]);
    }

    public function username()
    {
        return 'Usuario';
    }

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/admin');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('usuario', 'password');
        
        if(Auth::guard('admin')->attempt($credentials, true)) {
            
            $user = Auth::guard('admin')->user();
            Session::put('guard', 'admin');
            
            session::put("usuario",json_encode($user));
            return redirect()->intended('/admin');
        } else {
            return redirect()->intended('/login');
        }

    }

    public function logout(Request $request)
    {
        Session::flush();
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect('/login');
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
