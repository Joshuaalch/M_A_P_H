<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MensualidadUsuarioController;

// Redirigir a /lobby si ya está autenticado y trata de acceder a /login
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect()->route('lobby'); // Redirigir al lobby si está logueado
        }
        return view('auth.login');
    })->name('login');
});

// Permitir el acceso a /register sin restricciones
Route::get('/register', function () {
    return view('auth.register'); // Permite que el usuario se registre normalmente
})->name('register');

// Rutas protegidas por autenticación (solo para usuarios logueados)
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

// Página de bienvenida accesible sin autenticación
Route::get('/', function () {
    return view('welcome');
});

// Autenticación
Auth::routes(); // Se habilitan todas las rutas de autenticación, incluyendo register


Route::get('/usuarios/{id_cedula}/mensualidades', [MensualidadUsuarioController::class, 'index'])->name('mensualidad.index');
Route::post('/mensualidad', [MensualidadUsuarioController::class, 'store'])->name('mensualidad.store');
Route::delete('/mensualidad/{id}', [MensualidadUsuarioController::class, 'destroy'])->name('mensualidad.destroy');
Route::get('/mensualidad/{id}/edit', [MensualidadUsuarioController::class, 'edit'])->name('mensualidad.edit');
Route::put('/mensualidad/{id}', [MensualidadUsuarioController::class, 'update'])->name('mensualidad.update');
