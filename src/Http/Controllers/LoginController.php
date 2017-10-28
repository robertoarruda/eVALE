<?php

namespace Nero\Evale\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

abstract class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $guard;

    /**
     * @var Illuminate\Support\Facades\Auth
     */
    protected $auth;

    /**
     * @see Illuminate\Foundation\Auth::showLoginForm()
     */
    public function showLoginForm()
    {
        if ($this->auth::guard('company')->check()) {
            return redirect()->route('company.index');
        }

        if ($this->auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view("{$this->guard}.auth.login");
    }

    /**
     * @see Illuminate\Foundation\Auth::redirectTo()
     */
    protected function redirectTo()
    {
        return "/{$this->guard}";
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
        $this->guard($this->guard)->logout();

        $request->session()->invalidate();

        return redirect()->route("{$this->guard}.index");
    }

    /**
     * @see Illuminate\Foundation\Auth::guard()
     */
    protected function guard()
    {
        return $this->auth::guard($this->guard);
    }
}
