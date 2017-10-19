<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|S
 */

Route::resource('company', '\Nero\ValeExpress\Http\Controllers\CompanyController');

// -----------------------------------------------------------------------

Route::get('/example', function () {
    return view('example.home');
});

Route::get('/login', function () {
    return view('example.auth.login');
});

Route::get('/charts', function () {
    return View::make('example.charts');
});

Route::get('/tables', function () {
    return View::make('example.table');
});

Route::get('/forms', function () {
    return View::make('example.form');
});

Route::get('/grid', function () {
    return View::make('example.grid');
});

Route::get('/buttons', function () {
    return View::make('example.buttons');
});

Route::get('/icons', function () {
    return View::make('example.icons');
});

Route::get('/panels', function () {
    return View::make('example.panel');
});

Route::get('/typography', function () {
    return View::make('example.typography');
});

Route::get('/notifications', function () {
    return View::make('example.notifications');
});

Route::get('/blank', function () {
    return View::make('example.blank');
});

Route::get('/documentation', function () {
    return View::make('example.documentation');
});

Route::get('/stats', function () {
    return View::make('example.stats');
});

Route::get('/progressbars', function () {
    return View::make('example.progressbars');
});

Route::get('/collapse', function () {
    return View::make('example.collapse');
});
