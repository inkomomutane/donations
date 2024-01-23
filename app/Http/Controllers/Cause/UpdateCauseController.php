<?php

namespace App\Http\Controllers\Cause;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCauseController extends Controller
{
    public function __invoke(Cause $cause,Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('causes','title')->ignore($cause->id)],
            'description' => ['required', 'string', 'max:255'],
        ]);

        try {
            $cause->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Erro ao actualizar causa!');
            return redirect()->route('cause.index');
        }
        $request->session()->flash('message', 'Causa actualizada com sucesso!');
        return redirect()->route('cause.index');
    }
}
