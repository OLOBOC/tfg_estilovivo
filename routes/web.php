<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\AdminPeluqueroController;
use App\Http\Controllers\AgendaController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome', ['mensaje' => 'Bienvenido cliente']);
})->name('home');

Route::get('/search', [BusquedaController::class, 'buscar'])->name('search');
Route::get('/seccion-principal', function () {
    return view('partials.seccion-principal');
})->name('seccion-principal');

// Galería pública
Route::get('/peluqueria', [GaleriaController::class, 'index'])->name('galeria.index');

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Citas
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas/crear', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/mis', [CitaController::class, 'misCitas'])->name('citas.mis');
    Route::get('/horas-ocupadas', [CitaController::class, 'horasOcupadas'])->name('citas.ocupadas');
    Route::get('/cita-previa', [CitaController::class, 'create'])->name('cita-previa');
    Route::delete('/citas/eliminar', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::get('/citas/{cita}', [CitaController::class, 'show'])->name('citas.show');

    // Galería
    Route::get('/galeria/create', [GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::get('/galeria/{id}/edit', [GaleriaController::class, 'edit'])->name('galeria.edit');
    Route::put('/galeria/{id}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{id}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');

    // Guardar y ver guardadas
    Route::post('/galeria/{id}/guardar', [GaleriaController::class, 'guardar'])->name('galeria.guardar');
    Route::get('/galeria/guardadas', [GaleriaController::class, 'guardadas'])->name('galeria.guardadas');

    // Agenda del peluquero
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

    // Admin gestiona peluqueros
    Route::get('/admin/peluquero/create', [AdminPeluqueroController::class, 'create'])->name('admin.peluquero.create');
    Route::post('/admin/peluquero/create', [AdminPeluqueroController::class, 'store'])->name('admin.peluquero.store');
    Route::get('/admin/peluqueros', [AdminPeluqueroController::class, 'index'])->name('admin.peluquero.index');
});

/*
|--------------------------------------------------------------------------
| RUTAS POR ROL
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {
    return view('welcome', ['mensaje' => 'Bienvenido administrador']);
})->name('admin.dashboard');

Route::get('/peluquero/dashboard', function () {
    return view('welcome', ['mensaje' => 'Bienvenido peluquero']);
})->name('peluquero.dashboard');

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');
