<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;

class DeleteCampaignController extends Controller
{
    public function __invoke(Campaign $campaign)
    {
        try {
            $campaign->delete();
            flash()->addSuccess('Campanha eliminada com sucesso');
        }catch (\Exception $exception){
            flash()->addError('Erro ao eliminar campanha');
        }
        return redirect()->route('dashboard');
    }
}
