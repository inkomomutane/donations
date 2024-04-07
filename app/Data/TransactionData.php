<?php

namespace App\Data;

use App\Enums\CampaignPaymentMethodEnum;
use App\Models\CampaignTransaction;
use Spatie\LaravelData\Data;

/** @typescript  */
class TransactionData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public float $amount,
        public CampaignPaymentMethodEnum $paymentMethod,
        public  string $transactionId,
        public string $createdAt,
    ){}

    public static function fromModel(CampaignTransaction $transaction): self
    {
        // use pt location on format date
        return new self(
            id: $transaction->id,
            name: $transaction->name,
            amount: $transaction->amount,
            paymentMethod: $transaction->payment_method,
            transactionId: $transaction->transaction_id,
            createdAt: $transaction->created_at->translatedFormat('j/F/Y')
        );
    }
}
