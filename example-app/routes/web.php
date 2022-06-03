<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PermissionController;

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

/*  */
Route::get('/', function() {
    return view('index');
});

/* Login */
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

/* Permissions */
Route::post('createPerm', [PermissionController::class, 'create']);
Route::post('removePerm', [PermissionController::class, 'remove']);
Route::post('addPerm', [PermissionController::class, 'add']);
Route::post('deletePerm', [PermissionController::class, 'delete']);

/* Dashboard */
Route::get('/dashboard/home', function() {
    return view('dashboard/home');
})->middleware('auth');


/* Testing */
Route::get('test2', function() {
    return view('test2');
});
