<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('admin')->group(function () {
    $controller = '\Nero\ValeExpress\Http\Controllers\AdminLoginController';
    Route::post('login', "{$controller}@login");
    Route::match(['get', 'head'], 'login', "{$controller}@showLoginForm")
        ->name('admin.login');
    Route::post('logout', "{$controller}@logout")
        ->name('admin.logout');
});

Route::resource(
    'admin',
    '\Nero\ValeExpress\Http\Controllers\AdminController',
    ['parameters' => ['admin' => 'companyId']]
)->middleware('auth:admin');

Route::prefix('company')->group(function () {
    $controller = '\Nero\ValeExpress\Http\Controllers\CompanyLoginController';
    Route::post('login', "{$controller}@login");
    Route::match(['get', 'head'], 'login', "{$controller}@showLoginForm")
        ->name('company.login');
    Route::post('logout', "{$controller}@logout")
        ->name('company.logout');
});

Route::resource(
    'company',
    '\Nero\ValeExpress\Http\Controllers\CompanyController',
    ['parameters' => ['company' => 'employeeId']]
)->middleware('auth:company');

Route::get('/', '\Nero\ValeExpress\Http\Controllers\CompanyController@index')
    ->middleware('auth:company');