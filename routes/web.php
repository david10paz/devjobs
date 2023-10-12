<?php

use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, '__invoke'])->name('home');

Route::get('/dashboard', [VacanteController::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index');
Route::get('/vacantes/create', [VacanteController::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');
Route::get('/candidatos/{vacante}/{notificacion?}', [CandidatosController::class, 'index'])->name('candidatos.index');
Route::post('/candidatos/{vacante}/{user}', [CandidatosController::class, 'rechazar'])->name('candidatos.rechazar');
Route::get('/mis-candidaturas/{user}', [CandidatosController::class, 'show'])->middleware(['auth', 'verified'])->name('candidaturas.show');

//Notificaciones (Le ponemos el middleware creado rol.reclutador porque las notificaciones solo pueden ser visibles por los recruiters)
Route::get('/notificaciones', [NotificacionController::class, '__invoke'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones');
Route::post('/notificacion/{notificacion}', [NotificacionController::class, 'destroy'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificacion.destroy');

require __DIR__.'/auth.php';
