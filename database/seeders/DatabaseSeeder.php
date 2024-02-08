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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'lenpio',
            'email' => 'lenpiotoxix@gmail.com',
            'password' => bcrypt('deidera25'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'guigz',
            'email' => 'guigz@gmail.com',
            'password' => bcrypt('guigzguigz'),
        ]);

        $character1 = \App\Models\Character::create([
            'name' => 'Hugo Janna',
            'health' => 13,
            'user_id' => 1,
        ]);

        $character2 = \App\Models\Character::create([
            'name' => 'Strybim',
            'health' => 16,
            'user_id' => 2,
        ]);

        \App\Models\CharInfo::create([
            'info' => 'Il existe',
            'is_secret' => 1,
            'character_id' => 1,
        ]);

        \App\Models\CharInfo::create([
            'info' => 'Il est là',
            'is_secret' => 0,
            'character_id' => 2,
        ]);
        
        \App\Models\Table::create([
            'name' => '@table',
            'info' => 1,
        ]);

        \App\Models\Table::create([
            'name' => 'contes-table',
            'info' => 1,
        ]);

        $character1->tables()->attach(2);
        $character2->tables()->attach(1);

    }
}
