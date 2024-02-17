<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharNote;
use Illuminate\Support\Facades\Validator;

class ActionController extends Controller
{
    /**
     * bla bla bla
     */
    public function handle(Request $request)
    {
        // dd($request);
        $validated = Validator::make($request->only('note'), [
            'note' => 'nullable',
        ])->valid();

        CharNote::create(['note' => $validated['note'], 'character_id' => $request->char_id]);

        session()->flash('flash.banner', 'Contenu mis à jour');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();
    }
}
