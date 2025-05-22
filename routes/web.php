<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\BusquedaController;

// 🌐 Página principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ✅ Dashboard protegido
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


// 🗓️ Rutas de Citas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas/crear', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/mis', [CitaController::class, 'misCitas'])->name('citas.mis');
    Route::get('/horas-ocupadas', [CitaController::class, 'horasOcupadas'])->name('citas.ocupadas');
    Route::get('/cita-previa', [CitaController::class, 'create'])->name('cita-previa');
});
Route::middleware('auth')->delete('/citas/eliminar', [CitaController::class, 'destroy'])->name('citas.destroy');

// 🎨 Galería (futura función de peluquero)
Route::get('/peluqueria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/galeria/crear', [GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
});

// 🔍 Búsqueda (si aplicable)
Route::get('/search', [BusquedaController::class, 'buscar'])->name('search');

// 👤 Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🌟 Modal o sección destacada
Route::get('/seccion-principal', function () {
    return view('partials.seccion-principal');
})->name('seccion-principal');

// 🔐 Auth routes
require __DIR__.'/auth.php';
