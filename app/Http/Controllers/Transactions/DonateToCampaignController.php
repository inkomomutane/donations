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
        $reference = strtolower((\Str::substr(((string) \Str::ulid()),0,12)));
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


            if($response->getStatusCode() === '201' || $response->getStatusCode() === '200'){
                CampaignTransaction::create([
                   'amount' =>(float) $validatedData['amount'],
                   'payment_method' => 'M_PESA',
                   'name'  => $validatedData['name'] ?? 'Anónimo',
                    'campaign_id' => $campaign->id,
                    'transaction_id' => $reference,
                ]);
                $campaign->update([
                    'current_amount' => $campaign->current_amount + $validatedData['amount']
                ]);
                $campaign->update();
                $campaign->refresh();
                if($campaign->current_amount >= $campaign->goal_amount){
                    $campaign->update([
                        'status' => 'COMPLETA'
                    ]);
                    $campaign->save();

                }
            }else{
                DB::rollBack();
                flash()->addError('Erro ao fazer a sua doação.');
                return redirect()->back();
            }
            DB::commit();
            flash()->addSuccess('Doação feita com sucesso. \n Obrigado por fazer parte da comunidade.');
            return redirect()->back();
        } catch (Exception $exception) {
            dd($exception);
            flash()->addError('Erro ao fazer a sua doação.');
            return redirect()->back();
        }
    }
}
