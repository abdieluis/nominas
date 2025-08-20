<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PlantaController;
use App\Http\Controllers\PrestacionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssistanceController;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard'); // Inertia busca en 'resources/js/pages/Dashboard.vue'
    })->name('/dashboard');
});

Route::prefix('assistence')->group(function () {
    Route::resource('absent', AssistanceController::class);
//     Route::resource('purchase-orders-invoices', SupplierInvoicesController::class);
//     Route::resource('supplier', SupplierController::class);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/plantas', [PlantaController::class, 'byUser'])->name('plantas');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('catalogos')->group(function () {
    //Poner aqui las rutas, por defecto ya iran de la manera /catalogos/ruta solo poner Route::resource('nombre', Controlador::class)
    Route::get('prestaciones', [PrestacionController::class, 'index'])->name('/catalogos/prestaciones');
    Route::resource('prestaciones', PrestacionController::class)->except(['index']);
    Route::get('plantas', [PlantaController::class, 'index'])->name('catalogos.plantas.index');

});

//Route::get('/plantas', [PlantaController::class, 'byUser'])->name('plantas');
//Route::get('/planta/usuario', [EmpleadoController::class, 'getPlantaEmpleado'])->name('planta.usuario');

