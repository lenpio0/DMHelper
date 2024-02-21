<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\CharNote;
use App\Models\CharInfo;
use App\Models\Buff;
use Illuminate\Support\Facades\Validator;

class ActionController extends Controller
{
    /**
     * bla bla bla
     */
    public function handle(Request $request)
    {
        // dd($request);

        switch ($request->action) {
            
            case "add-char-note":

                $validated = Validator::make($request->only('note'), [
                    'note' => 'nullable',
                ])->valid();

                CharNote::create([
                    'note' => $validated['note'],
                    'character_id' => $request->char_id
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'del-char-note':

                $charNote = CharNote::findOrFail($request->note_id);
                $charNote->delete();

                break;

            case 'edit-char-note':

                $validated = Validator::make($request->only('note'), [
                    'note' => 'nullable',
                ])->valid();

                $charNote = CharNote::findOrFail($request->note_id);
                $charNote->update($validated);

                break;

            case "add-char-info":
                $validated = Validator::make($request->only(['info', 'is_secret']), [
                    'info' => 'nullable',
                ])->valid();

                CharInfo::create([
                    'info' => $validated['info'], 
                    'character_id' => $request->char_id,
                    'is_secret' => $validated['is_secret']
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'del-char-info':

                $charInfo = CharInfo::findOrFail($request->info_id);
                $charInfo->delete();

                break;

            case 'edit-char-info':

                $validated = Validator::make($request->only('info'), [
                    'info' => 'nullable',
                ])->valid();

                $charInfo = CharInfo::findOrFail($request->info_id);
                $charInfo->update($validated);

                break;

            case "add-buff":
                $validated = Validator::make($request->only(['name', 'desc', 'is_debuff']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $buff = Buff::create([
                    'name' => $validated['name'],
                    'desc' => $validated['desc'],
                    'is_debuff' => $validated['is_debuff']
                ]);

                $character = Character::findOrFail($request->char_id);
                $character->buffs()->attach($buff);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'del-buff':

                $buff = Buff::findOrFail($request->buff_id);
                $buff->delete();

                break;

            case 'edit-buff':

                $validated = Validator::make($request->only(['name', 'desc', 'is_debuff']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $buff = Buff::findOrFail($request->buff_id);
                $buff->update($validated);

                break;
        }
    }
}
