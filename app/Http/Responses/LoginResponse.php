<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // Redirect to a specific route after login
        return redirect()->route('user.show', ['id' => auth()->user()->id]);
    }
}
