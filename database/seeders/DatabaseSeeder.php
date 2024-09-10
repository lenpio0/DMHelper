<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'lenpio',
            'email' => 'lenpiotoxix@gmail.com',
            'password' => bcrypt('deidera25'),
        ]);

        \App\Models\Character::create([
            'name' => 'Hugo Janna',
            'max_health' => 13,
            'act_health' => 13,
            'user_id' => 1,
        ]);

        \App\Models\User::factory(5)->hasCharacters(2)->create()->each(function ($user) {
            $user->characters->each(function ($character) {
                $table = \App\Models\Table::factory(1)->create();
                $character->tables()->attach($table);
                $buffs = \App\Models\Buff::factory(2)->create();
                $character->buffs()->attach($buffs);
                $spells = \App\Models\Spell::factory(2)->create();
                $character->spells()->attach($spells);
            });
        });

        \App\Models\CharInfo::factory(12)->create();
        \App\Models\CharNote::factory(12)->create();
        \App\Models\GlobInfo::factory(12)->create();
        \App\Models\DmInfo::factory(12)->create();
        \App\Models\Item::factory(12)->create();

    }
}
