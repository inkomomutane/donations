<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Início das rotas para o CRUD de Províncias
    Route::get('/todas/provincias', App\Http\Controllers\Province\GetProvincesController::class)
        ->name('provincias.index');
    Route::get('/provincia/criar', App\Http\Controllers\Province\CreateProvinceController::class)
        ->name('provincias.create');
    Route::post('/provincia/salvar', App\Http\Controllers\Province\StoreProvinceController::class)
        ->name('provincias.store');
    Route::get('/provincia/{province}/editar', App\Http\Controllers\Province\EditProvinceController::class)
        ->name('provincias.edit');
    Route::patch('/provincia/{province}/atualizar', App\Http\Controllers\Province\UpdateProvinceController::class)
        ->name('provincias.update');
    Route::delete('/provincia/{province}/deletar', App\Http\Controllers\Province\DeleteProvinceController::class)
        ->name('provincias.destroy');
    // Fim das rotas para o CRUD de Províncias
});


require __DIR__.'/auth.php';
