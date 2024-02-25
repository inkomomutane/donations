<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignTransaction;
use DB;
use Exception;
use Illuminate\Http\Request;
use Samuelbie\Mpesa\Transaction;

class DonateToCampaignController extends Controller
{

    private function rules() :array
    {
        return [
            'name' => ['string','nullable'],
            'amount' => ['required','numeric','min:1'],
            'phone' => ['required','string']
        ];
    }

    public function __invoke(Campaign $campaign,Request $request)
    {

        $reference = (\Str::substr(((string) \Str::ulid()),0,6));
        $validatedData =$request->validate(
            $this->rules(),
        );

        try {
            DB::beginTransaction();
            $transaction = new Transaction();

            $response = $transaction->c2b(
                amount:  $validatedData['amount'],
                msisdn: $validatedData['phone'],
                reference:$reference,
                third_party_reference:$reference,
            );

            if($response->getResponse() === '201'){
                CampaignTransaction::create([
                   'amount' => $validatedData['amount'],
                   'payment_method' => 'MPESA',
                   'name'  => $reference,
                    'campaign_id' => $campaign->id
                ]);
                $campaign->update([
                    'current_amount' => $campaign->current_amount + $validatedData['amount']
                ]);
                $campaign->update();
                $campaign->refresh();
            }
            DB::commit();
            flash()->addSuccess('Doação feita com sucesso. \n Obrigado por fazer parte da comunidade.');
            return redirect()->back();
        } catch (Exception) {
            flash()->addError('Erro ao fazer a sua doação.');
            return redirect()->back();
        }
    }
}
