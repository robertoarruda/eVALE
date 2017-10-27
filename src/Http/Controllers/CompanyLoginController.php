<?php

namespace Nero\Evale\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyLoginController extends Controller
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
        if (Auth::guard('company')->check()) {
            return redirect()->route('company.index');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('company.auth.login');
    }

    /**
     * @see Illuminate\Foundation\Auth::redirectTo()
     */
    protected function redirectTo()
    {
        return '/company';
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
        $this->guard('company')->logout();

        $request->session()->invalidate();

        return redirect()->route('company.index');
    }

    /**
     * @see Illuminate\Foundation\Auth::guard()
     */
    protected function guard()
    {
        return Auth::guard('company');
    }
}
