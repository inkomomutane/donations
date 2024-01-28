<?php

use App\Http\Controllers\District\CreateDistrict;
use App\Http\Controllers\District\DeleteDistrict;
use App\Http\Controllers\District\GetDistricts;
use App\Http\Controllers\District\UpdateDistrict;
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
        ->name('province.index');
    Route::get('/provincia/criar', App\Http\Controllers\Province\CreateProvinceController::class)
        ->name('province.create');
    Route::post('/provincia/salvar', App\Http\Controllers\Province\StoreProvinceController::class)
        ->name('province.store');
    Route::get('/provincia/{province}/editar', App\Http\Controllers\Province\EditProvinceController::class)
        ->name('province.edit');
    Route::patch('/provincia/{province}/atualizar', App\Http\Controllers\Province\UpdateProvinceController::class)
        ->name('province.update');
    Route::delete('/provincia/{province}/deletar', App\Http\Controllers\Province\DeleteProvinceController::class)
        ->name('province.delete');
    // Fim das rotas para o CRUD de Províncias
    // Início das rotas para o CRUD de Causas
    Route::get('/todas/causas', App\Http\Controllers\Cause\GetCausesController::class)
        ->name('cause.index');
    Route::post('/causa/salvar', App\Http\Controllers\Cause\StoreCauseController::class)
        ->name('cause.store');
    Route::patch('/causa/{cause}/atualizar', App\Http\Controllers\Cause\UpdateCauseController::class)
        ->name('cause.update');
    Route::delete('/causa/{cause}/deletar', App\Http\Controllers\Cause\DeleteCauseController::class)
        ->name('cause.delete');

    #--- District Routes ---#

    Route::get('/district/list', GetDistricts::class)->name('district.list');
    Route::post('/district/store', CreateDistrict::class)->name('district.store');
    Route::match(['put','patch'],'/district/{district}/update', UpdateDistrict::class)->name('district.update');
    Route::delete('/district/{district}/delete', DeleteDistrict::class)->name('district.delete');
});


require __DIR__.'/auth.php';
