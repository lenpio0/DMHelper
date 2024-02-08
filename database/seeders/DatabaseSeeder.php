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

        \App\Models\Character::create([
            'name' => 'Hugo Janna',
            'health' => 13,
            'user_id' => 1,
        ]);

        \App\Models\CharInfo::create([
            'info' => 'Il existe',
            'is_secret' => 1,
            'character_id' => 1,
        ]);
    }
}
