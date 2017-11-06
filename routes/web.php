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

Route::get('/', '\Nero\Evale\Http\Controllers\CompanyController@index')
    ->middleware('auth:company');

Route::prefix('admin')
    ->group(function () {
        $controller = '\Nero\Evale\Http\Controllers\AdminLoginController';
        Route::post('login', "{$controller}@login");
        Route::match(['get', 'head'], 'login', "{$controller}@showLoginForm")
            ->name('admin.login');
        Route::post('logout', "{$controller}@logout")
            ->name('admin.logout');
    });

Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {
        $controller = '\Nero\Evale\Http\Controllers\AdminController';
        Route::get('fillup', "{$controller}@fillUp")->name('admin.fillUp');
        Route::post('fillup', "{$controller}@postFillUp")->name('admin.postFillUp');
        Route::get('reports', "{$controller}@reports")->name('admin.reports');
    });

Route::resource(
    'admin',
    '\Nero\Evale\Http\Controllers\AdminController',
    ['parameters' => ['admin' => 'companyId']]
)->middleware('auth:admin');

Route::prefix('company')
    ->group(function () {
        $controller = '\Nero\Evale\Http\Controllers\CompanyLoginController';
        Route::post('login', "{$controller}@login");
        Route::match(['get', 'head'], 'login', "{$controller}@showLoginForm")
            ->name('company.login');
        Route::post('logout', "{$controller}@logout")
            ->name('company.logout');
    });

Route::prefix('company')
    ->middleware('auth:company')
    ->group(function () {
        $controller = '\Nero\Evale\Http\Controllers\CompanyController';
        Route::get('reports', "{$controller}@reports")->name('company.reports');
    });

Route::resource(
    'company',
    '\Nero\Evale\Http\Controllers\CompanyController',
    ['parameters' => ['company' => 'employeeId']]
)->middleware('auth:company');
