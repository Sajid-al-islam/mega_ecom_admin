<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name','.*');
});

Route::get('/home', function () {
    return view('home');
});




Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
Auth::routes();
