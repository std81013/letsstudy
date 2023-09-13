<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
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

Route::get('/', [EventController::class, 'dashboard']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);

Route::get('/event/view/{id}', [EventController::class, 'view']);

Route::post('/send/forgetMail', [AuthController::class, 'sendForgetMail']);

Route::get('/user/resetPassword', [AuthController::class, 'resetPassword']);
Route::post('/user/updatePassword', [AuthController::class, 'updatePassword']);

Route::middleware(['auth'])->group(function () {
    Route::post('/user/store', [AuthController::class, 'store']);
    Route::get('/register/successfully/{token}', [AuthController::class, 'registerSuccess']);

    Route::get('/event/list', [EventController::class, 'list']);
    Route::get('/event/join/{id}', [EventController::class, 'join']);
    Route::post('/event/join', [EventController::class, 'joinEvent']);
    Route::get('/event/add', [EventController::class, 'manage']);
});

Route::get('/mail', function () {
    Mail::to('s0952785388@gmail.com')->send(new OrderShipped());
});