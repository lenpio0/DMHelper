<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\CharNote;
use App\Models\CharInfo;
use App\Models\Buff;
use App\Models\Item;
use App\Models\Spell;
use App\Models\Table;
use App\Models\GlobInfo;
use App\Models\DmInfo;
use App\Models\User;
use Inertia\Inertia;
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
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'del-char-note':

                $charNote = CharNote::findOrFail($request->note_id);
                $charNote->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'edit-char-note':

                $validated = Validator::make($request->only('note'), [
                    'note' => 'nullable',
                ])->valid();

                $charNote = CharNote::findOrFail($request->note_id);
                $charNote->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

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
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'del-char-info':

                $charInfo = CharInfo::findOrFail($request->info_id);
                $charInfo->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'edit-char-info':

                $validated = Validator::make($request->only('info'), [
                    'info' => 'nullable',
                ])->valid();

                $charInfo = CharInfo::findOrFail($request->info_id);
                $charInfo->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

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
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'del-buff':

                $buff = Buff::findOrFail($request->buff_id);
                $buff->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case 'edit-buff':

                $validated = Validator::make($request->only(['name', 'desc', 'is_debuff']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $buff = Buff::findOrFail($request->buff_id);
                $buff->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'charinfos');

                return redirect()->back();

            case "add-item":

                $validated = Validator::make($request->only(['name', 'desc']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                Item::create([
                    'name' => $validated['name'],
                    'desc' => $validated['desc'],
                    'character_id' => $request->char_id,
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'del-item':

                $item = Item::findOrFail($request->item_id);
                $item->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'edit-item':

                $validated = Validator::make($request->only(['name', 'desc']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $item = Item::findOrFail($request->item_id);
                $item->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case "add-spell":

                $validated = Validator::make($request->only(['name', 'desc']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $spell = Spell::create([
                    'name' => $validated['name'],
                    'desc' => $validated['desc'],
                ]);

                $character = Character::findOrFail($request->char_id);
                $character->Spells()->attach($spell);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'del-spell':

                $spell = Spell::findOrFail($request->spell_id);
                $spell->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case 'edit-spell':

                $validated = Validator::make($request->only(['name', 'desc']), [
                    'name' => 'nullable',
                    'desc' => 'nullable',
                ])->valid();

                $spell = Spell::findOrFail($request->spell_id);
                $spell->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'success');

                break;

            case "add-table":
                $validated = Validator::make($request->only(['name', 'char_ids', 'user_id']), [
                    'name' => 'nullable',
                    'char_ids' => 'array',
                    'char_ids.*' => 'exists:characters,id', // Ensure character IDs are valid     
                    'user_id' => 'exists:users,id',               
                ])->valid();

                $table = Table::create([
                    'name' => $validated['name'],
                    'user_id' => $validated['user_id']
                ]);

                // Attach characters to the table
                if (isset($validated['char_ids']) && !empty($validated['char_ids'])) {
                    $table->characters()->sync($validated['char_ids']);
                }

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'edit-table':

                $validated = Validator::make($request->only(['name', 'char_ids']), [
                    'name' => 'nullable',
                    'char_ids' => 'array',
                    'char_ids.*' => 'exists:characters,id', // Ensure character IDs are valid                    
                ])->valid();

                $table = Table::findOrFail($request->table_id);
                $table->update($validated);

                // Sync the character relations (this will remove unselected and add new ones)
                if (isset($validated['char_ids'])) {
                    $table->characters()->sync($validated['char_ids']);
                }

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'del-table':

                $table = Table::findOrFail($request->table_id);
                $table->dmInfos()->delete();
                $table->globInfos()->delete();
                $table->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case "add-glob-info":
                $validated = Validator::make($request->only(['info']), [
                    'info' => 'nullable',
                ])->valid();

                GlobInfo::create([
                    'info' => $validated['info'],
                    'table_id' => $request->table_id,
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'del-glob-info':

                $globInfo = GlobInfo::findOrFail($request->info_id);
                $globInfo->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'edit-glob-info':

                $validated = Validator::make($request->only('info'), [
                    'info' => 'nullable',
                ])->valid();

                $globInfo = GlobInfo::findOrFail($request->info_id);
                $globInfo->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'del-dm-info':

                $dmInfo = DmInfo::findOrFail($request->info_id);
                $dmInfo->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case "add-dm-info":
                $validated = Validator::make($request->only(['info']), [
                    'info' => 'nullable',
                ])->valid();

                DmInfo::create([
                    'info' => $validated['info'],
                    'table_id' => $request->table_id,
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case 'edit-dm-info':

                $validated = Validator::make($request->only('info'), [
                    'info' => 'nullable',
                ])->valid();

                $dmInfo = DmInfo::findOrFail($request->info_id);
                $dmInfo->update($validated);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();

            case "add-character":

                $validated = Validator::make($request->only(['name', 'max_health', 'act_health', 'user_id']), [
                    'name' => 'nullable',
                    'max_health' => 'nullable',
                    'act_health' => 'nullable',
                    'user_id' => 'required|exists:users,id'
                ])->valid();

                Character::create([
                    'name' => $validated['name'],
                    'max_health' => $validated['max_health'],
                    'act_health' => $validated['act_health'],
                    'user_id' => $validated['user_id']
                ]);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'chars');

                return redirect()->back();

            case 'edit-character':

                $validated = Validator::make($request->only('name', 'max_health', 'act_health', 'user_id'), [
                    'name' => 'nullable',
                    'max_health' => 'nullable',
                    'act_health' => 'nullable',
                    'user_id' => 'required|exists:users,id'
                ])->valid();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'chars');

                return redirect()->back();

            case 'del-character':

                $char = Character::findOrFail($request->char_id);
                $char->delete();

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'chars');

                return redirect()->back();

            case 'join-table':

                $char = Character::findOrFail($request->char_id);
                $table = Table::findOrFail($request->table_id);
                $table->Characters()->attach($char);

                session()->flash('flash.banner', 'Contenu mis à jour');
                session()->flash('flash.bannerStyle', 'Success');
                session()->flash('flash.tab', 'tables');

                return redirect()->back();
        }
    }
}
