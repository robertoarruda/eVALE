<?php

namespace Nero\ValeExpress\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @see Illuminate\Foundation\Auth::showLoginForm()
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('admin.auth.login');
    }

    /**
     * @see Illuminate\Foundation\Auth::redirectTo()
     */
    protected function redirectTo()
    {
        return '/admin';
    }

    /**
     * @see Illuminate\Foundation\Auth::username()
     */
    public function username()
    {
        return 'login';
    }

    /**
     * @see Illuminate\Foundation\Auth::logout()
     */
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();

        // $request->session()->invalidate();

        return redirect()->route('admin.index');
    }

    /**
     * @see Illuminate\Foundation\Auth::guard()
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
