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
    public function index()
    {
        $characters = Character::all();
        return response()->json($characters);
    }

}
