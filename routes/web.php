<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\UserController;


Route::get('/cekdpt/{nik}/detail', [BiodataController::class, 'show']);

Route::get('/', [AuthController::class, 'dashboard']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class);
Route::resource('bookings', BookingController::class);
Route::resource('facilities', FacilitiesController::class);
/*
GET|HEAD        users ................................................... users.index › UserController@index
POST            users ................................................... users.store › UserController@store
GET|HEAD        users/create .......................................... users.create › UserController@create
GET|HEAD        users/{user} .............................................. users.show › UserController@show
PUT|PATCH       users/{user} .......................................... users.update › UserController@update
DELETE          users/{user} ........................................ users.destroy › UserController@destroy
GET|HEAD        users/{user}/edit ......................................... users.edit › UserController@edit

*/


