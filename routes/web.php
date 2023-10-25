<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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

    Route::get('/event/list', [EventController::class, 'list']);
    Route::get('/event/add', [EventController::class, 'manage']);
    Route::get('/event/edit/{id}', [EventController::class, 'manage']);
    Route::post('/event/store', [EventController::class, 'store']);
    Route::get('/event/delete/{id}', [EventController::class, 'deleteEvent']);
    Route::post('/event/delete', [EventController::class, 'delete']);
});

Route::post('/user/store', [AuthController::class, 'store']);
Route::get('/register/successfully/{token}', [AuthController::class, 'registerSuccess']);
Route::get('/event/join/{eventId}/{userId}', [EventController::class, 'join']);
Route::post('/event/join', [EventController::class, 'joinEvent']);
Route::get('/user/introduction/{id}', [UserController::class, 'introduction']);
Route::get('/mail', function () {
    Mail::to('s0952785388@gmail.com')->send(new OrderShipped());
});