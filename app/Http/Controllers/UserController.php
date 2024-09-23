<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * bla bla bla
     */
    public function show(string $id)
    {
        $user = User::with('characters.buffs', 'characters.spells', 'characters.items', 'characters.charInfos', 'characters.charNotes', 'characters.tables', 'characters.tables.dmInfos', 'characters.tables.globInfos', 'characters.tables.characters')->find($id);

        $authUser = Auth::user();

        return Inertia::render('UserShow', compact('user', 'authUser'));
    }

    /**
     * bla bla bla
     */
    public function check(string $id)
    {
        $user = User::with('characters.buffs', 'characters.spells', 'characters.items', 'characters.charInfos', 'characters.charNotes', 'characters.tables', 'characters.tables.dmInfos', 'characters.tables.globInfos', 'characters.tables.characters')->find($id);

        if ($user) {
            return response()->json([
                'upuser' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'No user',
            ]);
        }
    }
    public function fetchAll()
    {
        $users = User::with('characters')->get();
        return response()->json($users);
    }

    public function goToChar($index, $userId)
    {
        // Redirect to the user's page with flash data
        return Redirect::route('user.show', ['id' => $userId])
                       ->with('flash', ['tab' => $index]);
    }

    public function updateRole(Request $request, $userId) {
        $user = User::findOrFail($userId);
        $user->role = $request->input('role');
        $user->save();
    
        return response()->json(['message' => 'Role updated']);
    }
}
