<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Exception;
use Illuminate\Http\Request;

class PostCampaignCommentController extends Controller
{
    public function rules():array
    {
        return [
            'name' => ['string','nullable'],
            'comment' => ['required','string']
        ];
    }

    public function __invoke(Campaign $campaign, Request $request)
    {
        try {
            $data = $request->validate($this->rules());
            $campaign->campaignComments()->create([
                'name' => ($data['name'] === null || ( $data['name'] === "") )  ? 'Anónimo' : $data['name'] ,
                'comment' => $data['comment'],
                'campaign_id' => $campaign->id
            ]);
            flash()->addSuccess('Comentário postado com sucesso!');
        }catch (Exception $exception){
            throw $exception;
            flash()->addError('Erro ao postar comentário!');
        }
        return redirect()->back();
    }
}
