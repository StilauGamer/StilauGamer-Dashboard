<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('index');
});
Route::get('/login', function() {
    return view('login');
});

/* Scripts */
Route::post('/login-script-V2.php', function (Request $request) {
    return view('login-script-V2');
});

/* Dashboard */
Route::get('/dashboard', function() {
    return view('home');
});
Route::get('/dashboard/', function() {
    return view('home');
});
Route::get('/dashboard/home', function() {
    return view('dashboard/home');
});
