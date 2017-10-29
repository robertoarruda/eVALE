<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Nero\Evale\Http\Controllers\LoginController;

class CompanyLoginController extends LoginController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->guard = 'company';
        $this->auth = $auth;
        $this->middleware('guest')->except('logout');
    }
}
