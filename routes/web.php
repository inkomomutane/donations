<?php

use App\Data\CampaignData;
use App\Http\Controllers\Campaign\DeleteCampaignController;
use App\Http\Controllers\Campaign\EditCampaignController;
use App\Http\Controllers\Campaign\PostCampaignCommentController;
use App\Http\Controllers\Campaign\ShowCampaignByCauseController;
use App\Http\Controllers\Campaign\StoreCampaignController;
use App\Http\Controllers\Campaign\UpdateCampaignController;
use App\Http\Controllers\Campaign\ViewCampaignOnWebsiteController;
use App\Http\Controllers\Campaign\WelcomeController;
use App\Http\Controllers\District\CreateDistrict;
use App\Http\Controllers\District\DeleteDistrict;
use App\Http\Controllers\District\GetDistricts;
use App\Http\Controllers\District\UpdateDistrict;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transactions\DonateToCampaignController;
use App\Models\Campaign;
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

Route::get('/', WelcomeController::class)->name('welcome');


Route::get('/dashboard',\App\Http\Controllers\Campaign\GetCampaignsController::class)->middleware(['auth', 'verified'])->name('dashboard');

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

    #--- Campaign routes --#
    Route::post('/campaign/store', StoreCampaignController::class)->name('campaign.store');
    Route::get('/campaign/{campaign}/edit', EditCampaignController::class)->name('campaign.edit');
    Route::post('/campaign/{campaign}/update', UpdateCampaignController::class)->name('campaign.update');
    Route::delete('/campaign/{campaign}/delete', DeleteCampaignController::class)->name('campaign.destroy');
    Route::get('/campaign/{cause}/show', ShowCampaignByCauseController::class)->name('campaign.show.cause');
//    ViewCampaignOnWebsiteController

});

Route::post('/campaign/{campaign}/donate', DonateToCampaignController::class)->name('campaign.donate');
Route::get('/campaign/{campaign}/view',ViewCampaignOnWebsiteController::class)->name('campaign.view');
Route::post('/campaign/{campaign}/comment', PostCampaignCommentController::class)->name('campaign.comment');
Route::get('/about-us',static fn() => Inertia::render('Website/about_us/AboutUs') )->name('about');
Route::get('/contact',static fn() => Inertia::render('Website/contact/Contact') )->name('contact');
Route::get('/policy',static fn() => Inertia::render('Website/Policy/Policy') )->name('policy');
Route::get('/all-campaigns',\App\Http\Controllers\Campaign\GetAllCampaignsController::class)->name('web.campaigns');

require __DIR__.'/auth.php';
