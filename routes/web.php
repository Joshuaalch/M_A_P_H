<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppointmentController;

Route::get('/appointments', [AppointmentController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');