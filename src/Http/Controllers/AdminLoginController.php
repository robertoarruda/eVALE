<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Nero\Evale\Http\Controllers\LoginController;

class AdminLoginController extends LoginController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->guard = 'admin';
        $this->auth = $auth;
        $this->middleware('guest')->except('logout');
    }
}
