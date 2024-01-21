<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;

class DeleteProvinceController extends Controller
{
    public function __invoke(Province $province)
    {
        try {
            $province->delete();
        } catch (\Exception $e) {
            request()?->session()->flash('message', 'Erro ao excluir província!');
            return redirect()->route('province.index');
        }
        request()?->session()->flash('message', 'Província excluída com sucesso!');
        return redirect()->route('province.index');
    }
}
