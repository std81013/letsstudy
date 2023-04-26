<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Mail\OrderShipped;

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
    return view('dashboard');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/store', [AuthController::class, 'store']);

//註冊mail信
//db script

Route::get('/mail', function () {
    Mail::to('s0952785388@gmail.com')->send(new OrderShipped());
});