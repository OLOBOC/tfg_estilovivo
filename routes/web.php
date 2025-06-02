<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\AdminPeluqueroController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CorteController;

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

Route::get('/peluqueria', [GaleriaController::class, 'index'])->name('galeria.index');

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // citas
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas/crear', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/mis', [CitaController::class, 'misCitas'])->name('citas.mis');
    Route::get('/horas-ocupadas', [CitaController::class, 'horasOcupadas'])->name('citas.ocupadas');
    Route::get('/cita-previa', [CitaController::class, 'create'])->name('cita-previa');
    Route::delete('/citas/eliminar', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::get('/citas/{cita}', [CitaController::class, 'show'])->name('citas.show');

    // galeria
    Route::get('/galeria/create', [GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::get('/galeria/{id}/edit', [GaleriaController::class, 'edit'])->name('galeria.edit');
    Route::put('/galeria/{id}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{id}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');
    Route::post('/galeria/{id}/guardar', [GaleriaController::class, 'guardar'])->name('galeria.guardar');
    Route::get('/galeria/guardadas', [GaleriaController::class, 'guardadas'])->name('galeria.guardadas');

    // agenda del peluquero
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

    // admin gestiona peluqueros
    Route::get('/admin/peluquero/create', [AdminPeluqueroController::class, 'create'])->name('admin.peluquero.create');
    Route::post('/admin/peluquero/create', [AdminPeluqueroController::class, 'store'])->name('admin.peluquero.store');
    Route::get('/admin/peluqueros', [AdminPeluqueroController::class, 'index'])->name('admin.peluquero.index');

    /*
    |--------------------------------------------------------------------------
    | CORTES (peluquero publica, cliente visualiza)
    |--------------------------------------------------------------------------
    */

    // ver cortes anteriores del cliente (opcional filtro ?antes=)
    Route::get('/clientes/{id}/cortes', [CorteController::class, 'verCortes'])->name('clientes.cortes');

    // formulario para subir nuevo corte
    Route::get('/clientes/{id}/cortes/create', [CorteController::class, 'crear'])->name('clientes.cortes.create');

    // guardar corte
    Route::post('/clientes/{id}/cortes', [CorteController::class, 'guardar'])->name('clientes.cortes.guardar');

    // editar corte
    Route::get('/cortes/{id}/edit', [CorteController::class, 'edit'])->name('cortes.edit');

    // actualizar corte
    Route::put('/cortes/{id}', [CorteController::class, 'update'])->name('cortes.update');

    // eliminar corte
    Route::delete('/cortes/{id}', [CorteController::class, 'destroy'])->name('cortes.destroy');

    // cliente ve sus propios cortes
    Route::get('/mis-cortes', [CorteController::class, 'misCortes'])->name('cliente.cortes');
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
