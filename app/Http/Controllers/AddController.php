<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharNote;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    /**
     * bla bla bla
     */
    public function store(Request $request, string $id)
    {
        // dd($request);
        $validated = Validator::make($request->all(), [
            'note' => 'nullable',
        ])->valid();

        CharNote::create(['note' => $validated['note'], 'character_id' => $id]);

        session()->flash('flash.banner', 'Contenu mis à jour');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }
}
