<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class StoreCampaignController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate($this->rules());
        $validated = \Arr::add($validated, 'posted_by_id',$request->user()->id);
        $validated = \Arr::add($validated, 'posted_at',now());
        try {
            \DB::beginTransaction();
            $campaign = Campaign::create($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file){
                    $campaign->addMedia($file)->toMediaCollection('campaigns');
                }
            }
            \DB::commit();
            flash()->addSuccess('Campanha criada com sucesso');
        }catch (\Exception $exception){
            throw  $exception;
            flash()->addError('Erro ao criar campanha');
        }
      return to_route('dashboard');
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
            'cause_id'=> ['required','exists:causes,id'],
            'images' => ['required']
        ];
    }

}
