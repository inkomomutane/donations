<?php

namespace App\Http\Controllers\Campaign;

use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Maatwebsite\Excel\Facades\Excel;

class DownloadTransactionExcelController extends Controller
{
    public function __invoke(Campaign $campaign)
    {
        return Excel::download(new TransactionsExport($campaign), 'Transacções da campanha.xlsx');
    }
}
