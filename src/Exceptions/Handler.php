<?php

namespace Nero\Evale\Exceptions;

use App\Exceptions\Handler as BaseHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends BaseHandler
{
    /**
     * @see Illuminate\Foundation\Exceptions\Handler::unauthenticated()
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $loginRoute = (explode('.', $request->route()->action['as'] ?? '')[0] == 'admin')
        ? 'admin.login'
        : 'company.login';

        return $request->expectsJson()
        ? response()->json(['message' => 'Unauthenticated.'], 401)
        : redirect()->guest(route($loginRoute));
    }
}
