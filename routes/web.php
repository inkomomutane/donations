<?php

use App\Data\CampaignData;
use App\Http\Controllers\Campaign\CampaignTransactionsController;
use App\Http\Controllers\Campaign\DeleteCampaignController;
use App\Http\Controllers\Campaign\DownloadTransactionExcelController;
use App\Http\Controllers\Campaign\EditCampaignController;
use App\Http\Controllers\Campaign\GetAllCampaignsController;
use App\Http\Controllers\Campaign\GetAllSucceededCampaignsController;
use App\Http\Controllers\Campaign\PostCampaignCommentController;
use App\Http\Controllers\Campaign\ReportController;
use App\Http\Controllers\Campaign\ShowCampaignByCauseController;
use App\Http\Controllers\Campaign\StoreCampaignController;
use App\Http\Controllers\Campaign\UpdateCampaignController;
use App\Http\Controllers\Campaign\ViewCampaignOnWebsiteController;
use App\Http\Controllers\Campaign\WelcomeController;
use App\Http\Controllers\District\CreateDistrict;
use App\Http\Controllers\District\DeleteDistrict;
use App\Http\Controllers\District\GetDistricts;
use App\Http\Controllers\District\UpdateDistrict;
use App\Http\Controllers\Organization\DeleteOrganizationController;
use App\Http\Controllers\Organization\ListOrganizationsController;
use App\Http\Controllers\Organization\StoreOrganizationController;
use App\Http\Controllers\Organization\UpdateOrganizationController;
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

Route::middleware(['auth','verified'])->group(function () {

    // users

    Route::get('/users',\App\Http\Controllers\User\GetUsers::class)->name('user.all');
    Route::post('/user/store',\App\Http\Controllers\User\CreateUser::class)->name('user.store');
    Route::match(['put','patch'],'/user/{user}/update',\App\Http\Controllers\User\UpdateUser::class)->name('user.update');
    Route::delete('/user/{user}/delete',\App\Http\Controllers\User\DeleteUser::class)->name('user.delete');


    Route::get('/organization/list', ListOrganizationsController::class)->name('organization.list');
    Route::post('/organization/store', StoreOrganizationController::class)->name('organization.store');
    Route::match(['put','patch'],'/organization/{organization}/update', UpdateOrganizationController::class)->name('organization.update');
    Route::delete('/organization/{organization}/delete', DeleteOrganizationController::class)->name('organization.delete');
//    ReportController

    Route::get('/reports', ReportController::class)->name('reports');
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
    Route::get('/campaign/{campaign}/transactions', CampaignTransactionsController::class)->name('campaign.transactions');
    //TransactionsExport
    Route::get('/campaign/{campaign}/download', DownloadTransactionExcelController::class)->name('campaign.download');
//    ViewCampaignOnWebsiteController

});

Route::post('/campaign/{campaign}/donate', DonateToCampaignController::class)->name('campaign.donate');
Route::get('/campaign/{campaign}/view',ViewCampaignOnWebsiteController::class)->name('campaign.view');
Route::post('/campaign/{campaign}/comment', PostCampaignCommentController::class)->name('campaign.comment');
Route::get('/about-us',static fn() => Inertia::render('Website/about_us/AboutUs') )->name('about');
Route::get('/contact',static fn() => Inertia::render('Website/contact/Contact') )->name('contact');
Route::get('/policy',static fn() => Inertia::render('Website/Policy/Policy') )->name('policy');
Route::get('/all-campaigns', GetAllCampaignsController::class)->name('web.campaigns');
Route::get('/succeeded-campaigns', GetAllSucceededCampaignsController::class)->name('web.succeeded.campaigns');

require __DIR__.'/auth.php';
