<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class StoreProvinceController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:provinces,name']
        ]);

        try {
            Province::create([
                'name' => $request->name
            ]);
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Erro ao criar província!');
            return redirect()->route('province.index');
        }
        $request->session()->flash('message', 'Província criada com sucesso!');
        return redirect()->route('province.index');
    }
}
