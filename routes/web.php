<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

// Ruta para mostrar la vista de editar perfil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Ruta para procesar la actualización del perfil
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Definir la ruta para el lobby
Route::get('/lobby', function() {
    return view('lobby');
})->name('lobby');

// Bandeja de entrada
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

// Detalle de un mensaje
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');

// Responder a un mensaje
Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

Route::get('/appointments', [AppointmentController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\SolicitudController;

Route::get('/solicitudes', [SolicitudController::class, 'index']);

Auth::routes();





Route::get('/usuarios', [UsuarioController::class, 'index']);

// Route::put('/users/deactivate/{id}', [UsersController::class, 'deactivate'])->name('users.deactivate');
// Route::put('/users/activate/{id}', [UsersController::class, 'activate'])->name('users.activate');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



