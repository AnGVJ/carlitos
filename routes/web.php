<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MaterialController;

use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;




Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('materiales', MaterialController::class);
Route::post('/materiales/import', [MaterialController::class, 'import'])->name('materiales.import');

Route::get('/inicio', [InicioController::class, 'inici'])->name('Inicio.inici');

Route::resource('proyectos', ProyectoController::class);
Route::post('proyectos/import', [ProyectoController::class, 'import'])->name('proyectos.import');
// web.php
Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
// web.php



//Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');




require __DIR__ . '/auth.php';

Route::get('/register', [ProfileController::class, 'register'])->name('register');
Route::post('/register', [ProfileController::class, 'store']);
Route::get('/', function () {
    return redirect()->route('login'); // Redirige a la ruta del login
});
Route::get('/dashboard', [ProyectoController::class, 'showProyectosEnDashboard'])->name('dashboard');
Route::get('/datos-grafica', [ProyectoController::class, 'obtenerDatosGrafica']);
Route::get('/proyecto/{nombreProyecto}', [ProyectoController::class, 'obtenerProyecto']);



Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
use App\Http\Controllers\TablaDinamicaController;



Route::get('/tabla-dinamica', [TablaDinamicaController::class, 'mostrarTablaDinamica'])->name('tabla.dinamica');
Route::get('/reporte-materiales', [TablaDinamicaController::class, 'generarReporte'])->name('reporte.materiales');



use App\Http\Controllers\PlanificacionController;

Route::post('/exportar-pdf', [PlanificacionController::class, 'exportarPDF'])->name('exportar.pdf');

// routes/web.php

use App\Http\Controllers\ImportController;

use App\Http\Controllers\SeguimientoController;



Route::post('/importar-materiales', [MaterialController::class, 'import'])->name('materiales.import');
Route::post('/importar-proyectos', [ProyectoController::class, 'import'])->name('proyectos.import');

use App\Http\Controllers\ReporteExcelController;

Route::get('/reportes-excel', [ReporteExcelController::class, 'index']);
Route::get('/seguimiento', function () {
    return view('seguimiento');
});

Route::get('seguimiento/{id}', [SeguimientoController::class, 'show'])->name('seguimiento.show');

