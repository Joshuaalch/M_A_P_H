<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MensualidadUsuarioController;

// Redirect to /lobby if already authenticated and trying to access /login
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect()->route('lobby'); // Redirect to lobby if logged in
        }
        return view('auth.login');
    })->name('login');
});

// Allow access to /register without restrictions
Route::get('/register', function () {
    return view('auth.register'); // Allows user to register normally
})->name('register');

// Protected routes (only for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/lobby', function () {
        return view('lobby');
    })->name('lobby');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('empresas', EmpresaController::class);

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

    Route::resource('usuarios', UsuarioController::class);
    Route::post('/usuarios/{usuario}/send-email', [UsuarioController::class, 'sendEmail'])->name('usuarios.sendEmail');

    Route::get('/solicitudes', [SolicitudController::class, 'index']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// Welcome page accessible without authentication
Route::get('/', function () {
    return view('welcome');
});

// Authentication
Auth::routes(); // Enable all authentication routes, including register

// Monthly payments related routes
Route::get('/usuarios/{id_cedula}/mensualidades', [MensualidadUsuarioController::class, 'index'])->name('mensualidad.index');
Route::post('/mensualidad', [MensualidadUsuarioController::class, 'store'])->name('mensualidad.store');
Route::delete('/mensualidad/{id}', [MensualidadUsuarioController::class, 'destroy'])->name('mensualidad.destroy');
Route::get('/mensualidad/{id}/edit', [MensualidadUsuarioController::class, 'edit'])->name('mensualidad.edit');
Route::put('/mensualidad/{id}', [MensualidadUsuarioController::class, 'update'])->name('mensualidad.update');
