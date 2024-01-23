<?php

namespace App\Http\Controllers\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProvinceController extends Controller
{
    public function __invoke(Province $province,Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('provinces','name')->ignore($province->id)]
        ]);

        try {
            $province->update([
                'name' => $request->name
            ]);
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Erro ao actualizar província!');
            return redirect()->route('province.index');
        }
        $request->session()->flash('message', 'Província actualizada com sucesso!');
        return redirect()->route('province.index');
    }
}
