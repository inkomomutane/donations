<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Cause;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Reports', [
            'causesCount' => Cause::count(),
            'campaignsCount' => Campaign::count(),
            'totalRaised' =>  Campaign::sum('current_amount'),
            'totalToRaise' => Campaign::sum('goal_amount'),
            'activeCampaigns' => Campaign::active()->count(),
        ]);
    }
}
