<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Inertia\Inertia;

class CampaignTransactionsController extends Controller
{
    public function __invoke(Campaign $campaign)
    {
        return Inertia::render('Campaign/Transactions', [
            'campaign' => $campaign->load('transactions')->getData()    ,
        ]);
    }
}
