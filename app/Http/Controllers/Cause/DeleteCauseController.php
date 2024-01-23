<?php

namespace App\Http\Controllers\Cause;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\Province;

class DeleteCauseController extends Controller
{
    public function __invoke(Cause $cause)
    {
        try {
            $cause->delete();
        } catch (\Exception $e) {
            request()?->session()->flash('message', 'Erro ao excluir causa!');
            return redirect()->route('cause.index');
        }
        request()?->session()->flash('message', 'Causa excluída com sucesso!');
        return redirect()->route('cause.index');
    }
}
