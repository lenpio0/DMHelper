<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Inertia\Inertia;

class CharacterController extends Controller
{
    /**
     * bla bla bla
     */
    public function fetchAll()
    {
        $characters = Character::all();
        return response()->json($characters);
    }
    
    public function updateCharacterHealth(Request $request, $characterId) {
        $character = Character::findOrFail($characterId);
        $character->act_health = $request->input('act_health');
        $character->max_health = $request->input('max_health');
        $character->save();
    
        return response()->json(['message' => 'Character health updated successfully']);
    }

}
