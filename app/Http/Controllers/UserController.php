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
        $user = User::find($id)->only('id', 'name', 'email', 'is_dm', 'characters');
        
        return Inertia::render('UserShow', compact('user'));
    }
}
