<?php

namespace App\Http\Controllers\Cause;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\Province;
use Illuminate\Http\Request;

class StoreCauseController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:causes,title'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        try {
            Cause::create([
                'title' => $request->title,
                'description' => $request->description,

            ]);
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Erro ao criar causa!');
            return redirect()->route('cause.index');
        }
        $request->session()->flash('message', 'Causa criada com sucesso!');
        return redirect()->route('cause.index');
    }
}
