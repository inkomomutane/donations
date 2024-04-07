<?php

namespace App\Exports;

use App\Data\TransactionData;
use App\Models\Campaign;
use App\Models\CampaignTransaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromArray,WithHeadings,WithStyles,ShouldAutoSize,WithColumnFormatting
{


    private Campaign $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign->load(['campaignTransactions']);
    }
    /**
    * @return array
    */
    public function array(): array
    {
        return $this->campaign->campaignTransactions->map(fn(CampaignTransaction $transaction) => [
            \Str::upper($transaction->transaction_id),
            $transaction->name,
            $transaction->amount,
            $transaction->payment_method,
            Date::dateTimeToExcel($transaction->created_at)
        ])->toArray();
    }

    public function headings(): array
    {
        return [
            'ID da Transacção',
            'Nome do dador/doador',
            'Montante',
            'Método de Pagamento',
            'Data da Transacção',
        ];
    }


    /**
     * @throws Exception
     */
    public function styles(Worksheet $sheet) :void
    {
        $sheet->setTitle( 'Transacções');
        $length = $this->campaign->campaignTransactions->count()  + 1;
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:E1')->getAlignment()->setVertical('center');
        $sheet->getStyle("A1:E$length")->getBorders()->getAllBorders()->setBorderStyle('thin');
        $sheet->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle('medium');
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
