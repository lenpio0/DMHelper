<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * bla bla bla
     */
    public function show(string $id)
    {
        $user = User::with('characters.buffs', 'characters.spells', 'characters.items', 'characters.charInfos', 'characters.charNotes', 'characters.tables', 'characters.tables.dmInfos', 'characters.tables.globInfos', 'characters.tables.characters')->find($id)->only('id', 'name', 'email', 'is_dm', 'characters');

        return Inertia::render('UserShow', compact('user'));
    }
}
