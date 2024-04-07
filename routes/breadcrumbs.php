<?php


use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('dashboard', static function (BreadcrumbTrail $trail) {
    $trail->push('Painel de administrador', route('dashboard'));
});


Breadcrumbs::for('reports', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Reportes', route('reports'));
});

Breadcrumbs::for('profile.edit', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Perfil', route('profile.edit'));
});



/**
 * // Início das rotas para o CRUD de Províncias
 * Route::get('/todas/provincias', App\Http\Controllers\Province\GetProvincesController::class)
 * ->name('province.index');
 * Route::get('/provincia/criar', App\Http\Controllers\Province\CreateProvinceController::class)
 * ->name('province.create');
 * Route::post('/provincia/salvar', App\Http\Controllers\Province\StoreProvinceController::class)
 * ->name('province.store');
 * Route::get('/provincia/{province}/editar', App\Http\Controllers\Province\EditProvinceController::class)
 * ->name('province.edit');
 * Route::patch('/provincia/{province}/atualizar', App\Http\Controllers\Province\UpdateProvinceController::class)
 * ->name('province.update');
 * Route::delete('/provincia/{province}/deletar', App\Http\Controllers\Province\DeleteProvinceController::class)
 * ->name('province.delete');
 * // Fim das rotas para o CRUD de Províncias
 * // Início das rotas para o CRUD de Causas
 * Route::get('/todas/causas', App\Http\Controllers\Cause\GetCausesController::class)
 * ->name('cause.index');
 * Route::post('/causa/salvar', App\Http\Controllers\Cause\StoreCauseController::class)
 * ->name('cause.store');
 * Route::patch('/causa/{cause}/atualizar', App\Http\Controllers\Cause\UpdateCauseController::class)
 * ->name('cause.update');
 * Route::delete('/causa/{cause}/deletar', App\Http\Controllers\Cause\DeleteCauseController::class)
 * ->name('cause.delete');
 *
 * #--- District Routes ---#
 *
 * Route::get('/district/list', GetDistricts::class)->name('district.list');
 * Route::post('/district/store', CreateDistrict::class)->name('district.store');
 * Route::match(['put','patch'],'/district/{district}/update', UpdateDistrict::class)->name('district.update');
 * Route::delete('/district/{district}/delete', DeleteDistrict::class)->name('district.delete');
 *
 * #--- Campaign routes --#
 * Route::post('/campaign/store', StoreCampaignController::class)->name('campaign.store');
 * Route::get('/campaign/{campaign}/edit', EditCampaignController::class)->name('campaign.edit');
 * Route::post('/campaign/{campaign}/update', UpdateCampaignController::class)->name('campaign.update');
 * Route::delete('/campaign/{campaign}/delete', DeleteCampaignController::class)->name('campaign.destroy');
 * Route::get('/campaign/{cause}/show', ShowCampaignByCauseController::class)->name('campaign.show.cause');
 * Route::get('/campaign/{campaign}/transactions', CampaignTransactionsController::class)->name('campaign.transactions');
 * //TransactionsExport
 * Route::get('/campaign/{campaign}/download', DownloadTransactionExcelController::class)->name('campaign.download');
 */

Breadcrumbs::for('province.index', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Todas as províncias', route('province.index'));
});

Breadcrumbs::for('province.create', static function (BreadcrumbTrail $trail) {
    $trail->parent('province.index');
    $trail->push('Criar província', route('province.create'));
});

Breadcrumbs::for('province.edit', static function (BreadcrumbTrail $trail, $province) {
    $trail->parent('province.index');
    $trail->push('Editar província', route('province.edit', $province));
});

Breadcrumbs::for('cause.index', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Todas as causas', route('cause.index'));
});

Breadcrumbs::for('cause.create', static function (BreadcrumbTrail $trail) {
    $trail->parent('cause.index');
    $trail->push('Criar causa', route('cause.create'));
});

Breadcrumbs::for('cause.edit', static function (BreadcrumbTrail $trail, $cause) {
    $trail->parent('cause.index');
    $trail->push('Editar causa', route('cause.edit', $cause));
});

Breadcrumbs::for('district.list', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Todas as distritos', route('district.list'));
});

Breadcrumbs::for('district.create', static function (BreadcrumbTrail $trail) {
    $trail->parent('district.list');
    $trail->push('Criar distrito', route('district.create'));
});

Breadcrumbs::for('district.edit', static function (BreadcrumbTrail $trail, $district) {
    $trail->parent('district.list');
    $trail->push('Editar distrito', route('district.edit', $district));
});


Breadcrumbs::for('campaign.create', static function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Criar campanha', route('campaign.create'));
});

Breadcrumbs::for('campaign.edit', static function (BreadcrumbTrail $trail, $campaign) {
    $trail->parent('dashboard');
    $trail->push('Editar campanha', route('campaign.edit', $campaign));
});

Breadcrumbs::for('campaign.show.cause', static function (BreadcrumbTrail $trail, $cause) {
    $trail->parent('dashboard');
    $trail->push('Campanhas por causa', route('campaign.show.cause', $cause));
});

Breadcrumbs::for('campaign.transactions', static function (BreadcrumbTrail $trail, $campaign) {
    $trail->parent('campaign.edit', $campaign);
    $trail->push('Transações da campanha', route('campaign.transactions', $campaign));
});
