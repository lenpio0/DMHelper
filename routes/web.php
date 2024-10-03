<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ActionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // DEFAULT
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    if (Auth::check()) {
        // Redirect to user's dashboard if authenticated
        return redirect()->route('user.show', ['id' => Auth::user()->id]);
    } else {
        // Redirect to login page if not authenticated
        return redirect()->route('login');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::post('/logout', function () {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect('/');
    })->name('logout');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/check/{id}', [UserController::class, 'check'])->name('user.check');
    Route::post('/actions', [ActionController::class,'handle'])->name('action.handle');
    Route::patch('/characters/{character}/update-health', [CharacterController::class, 'updateCharacterHealth']);
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole']);
    Route::get('/go-to-char/{index}/{userId}', [UserController::class, 'goToChar'])->name('goToChar');
});