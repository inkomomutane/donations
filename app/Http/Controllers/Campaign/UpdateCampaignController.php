<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class UpdateCampaignController extends Controller
{
    public function __invoke(Request $request, Campaign $campaign)
    {
        $validated = $request->validate($this->rules());
        try {
            \DB::beginTransaction();
            $campaign->update($validated);
            $campaign->refresh();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file){
                    $campaign->addMedia($file)->toMediaCollection('campaigns');
                }
            }
            \DB::commit();
            flash()->addSuccess('Campanha actualizada com sucesso');
        }catch (\Exception $exception){
            throw  $exception;
            flash()->addError('Erro ao actualizar campanha');
        }

        return redirect()->route('dashboard');
    }

    public  function rules() : array {
        return [
            'title' => 'required',
            'description' => ['required','string'],
            'goal_amount'=> ['required','numeric'],
            'current_amount'=> ['required','numeric'],
            'start_date' => ['required','date'],
            'end_date'=> ['required','date'],
            'status'=> ['required','string'],
            'priority'=> ['required','string'],
            'district_id' => ['required','exists:districts,id'],
            'cause_id'=> ['required','exists:causes,id']
        ];
    }
}
