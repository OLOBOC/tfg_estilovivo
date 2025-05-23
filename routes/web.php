<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\BusquedaController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// 🌐 Página principal según rol (cliente por defecto)
Route::get('/', function () {
    return view('welcome', ['mensaje' => 'Bienvenido cliente']);
})->name('home');


// 🔍 Buscador
Route::get('/search', [BusquedaController::class, 'buscar'])->name('search');

// 🌟 Sección destacada (modal o información)
Route::get('/seccion-principal', function () {
    return view('partials.seccion-principal');
})->name('seccion-principal');


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // 👤 Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🗓️ Citas
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas/crear', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/mis', [CitaController::class, 'misCitas'])->name('citas.mis');
    Route::get('/horas-ocupadas', [CitaController::class, 'horasOcupadas'])->name('citas.ocupadas');
    Route::get('/cita-previa', [CitaController::class, 'create'])->name('cita-previa');
    Route::delete('/citas/eliminar', [CitaController::class, 'destroy'])->name('citas.destroy');

    // 🎨 Galería (para peluqueros)
    Route::get('/galeria/crear', [GaleriaController::class, 'create'])->name('galeria.create');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
});

/*
|--------------------------------------------------------------------------
| RUTAS POR ROL (redirigen a welcome con mensaje)
|--------------------------------------------------------------------------
*/

// 🛡️ Admin
Route::get('/admin/dashboard', function () {
    return view('welcome', ['mensaje' => 'Bienvenido administrador']);
})->name('admin.dashboard');

// ✂️ Peluquero
Route::get('/peluquero/dashboard', function () {
    return view('welcome', ['mensaje' => 'Bienvenido peluquero']);
})->name('peluquero.dashboard');

// 🎨 Galería general
Route::get('/peluqueria', [GaleriaController::class, 'index'])->name('galeria.index');

// ✅ Redirección desde /dashboard protegida
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');


use App\Http\Controllers\AdminPeluqueroController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/peluquero/create', [AdminPeluqueroController::class, 'create'])->name('admin.peluquero.create');
    Route::post('/admin/peluquero/create', [AdminPeluqueroController::class, 'store'])->name('admin.peluquero.store');
    Route::get('/admin/peluqueros', [AdminPeluqueroController::class, 'index'])->name('admin.peluquero.index');
});




/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
