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
            'name' => 'admin',
            'email' => 'adminlenpiotoxix@gmail.com',
            'password' => bcrypt('deidera25'),
            'role' => 'admin',
        ],);

        \App\Models\User::factory()->create([
            'name' => 'Lenpio',
            'email' => 'lenpiotoxix@gmail.com',
            'password' => bcrypt('deidera25'),
            'role' => 'dm',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Zygomat',
            'email' => 'example1@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Piolita',
            'email' => 'example2@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Catty',
            'email' => 'example3@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Hiroshito',
            'email' => 'example4@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Johnny D',
            'email' => 'example5@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Dopabob',
            'email' => 'example6@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Yayomg',
            'email' => 'example7@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Willcoz',
            'email' => 'example8@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Samira',
            'email' => 'example9@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Evangel',
            'email' => 'example10@test.test',
            'password' => bcrypt('deidera25'),
            'role' => 'player',
        ]);

        $hugo = \App\Models\Character::create([
            'name' => 'Hugo Janna',
            'max_health' => 13,
            'act_health' => 13,
            'user_id' => 2,
        ]);

        $gundyr = \App\Models\Character::create([
            'name' => 'Gundyr Ortat',
            'max_health' => 25,
            'act_health' => 25,
            'user_id' => 4,
        ]);

        $larandel = \App\Models\Character::create([
            'name' => 'Larandel Delai',
            'max_health' => 15,
            'act_health' => 15,
            'user_id' => 4,
        ]);

        $sunbringer =\App\Models\Character::create([
            'name' => 'Sunbringer',
            'max_health' => 27,
            'act_health' => 27,
            'user_id' => 5,
        ]);

       $hortia = \App\Models\Character::create([
            'name' => 'Hortia Lodle',
            'max_health' => 14,
            'act_health' => 14,
            'user_id' => 6,
        ]);

        $nanto =\App\Models\Character::create([
            'name' => 'Nanto Irima',
            'max_health' => 18,
            'act_health' => 18,
            'user_id' => 7,
        ]);

        $gurk =\App\Models\Character::create([
            'name' => 'Gurk',
            'max_health' => 32,
            'act_health' => 32,
            'user_id' => 8,
        ]);

        $jan =\App\Models\Character::create([
            'name' => 'Jan Klarks',
            'max_health' => 12,
            'act_health' => 12,
            'user_id' => 9,
        ]);

        $leeroy = \App\Models\Character::create([
            'name' => 'Leeroy Jenkins',
            'max_health' => 21,
            'act_health' => 21,
            'user_id' => 10,
        ]);

        $grimar = \App\Models\Character::create([
            'name' => 'Grimar Naelda',
            'max_health' => 20,
            'act_health' => 20,
            'user_id' => 11,
        ]);

        $ultia = \App\Models\Character::create([
            'name' => 'Ultia the Third',
            'max_health' => 18,
            'act_health' => 18,
            'user_id' => 12,
        ]);

        $round_t = \App\Models\Table::create([
            'name' => 'The Round Table',
            'user_id' => 2,
        ]);

        $gundyr->tables()->attach($round_t);
        $larandel->tables()->attach($round_t);
        $sunbringer->tables()->attach($round_t);

        $skaven_t =\App\Models\Table::create([
            'name' => 'War against the Skavens',
            'user_id' => 3,
        ]);

        $hugo->tables()->attach($skaven_t);
        $hortia->tables()->attach($skaven_t);
        $nanto->tables()->attach($skaven_t);
        $larandel->tables()->attach($skaven_t);

        $noob_t = \App\Models\Table::create([
            'name' => 'Noob Table',
            'user_id' => 3,
        ]);

        $gurk->tables()->attach($noob_t);
        $jan->tables()->attach($noob_t);
        $leeroy->tables()->attach($noob_t);
        $grimar->tables()->attach($noob_t);
        $ultia->tables()->attach($noob_t);

        \App\Models\Item::create([
            'name' => 'Ancient Elf bow',
            'desc' => 'Longbow, +10 to CT when equipped, +1 damage, piercing damage',
            'character_id' => 1,
        ]);

        \App\Models\Item::create([
            'name' => 'Unidentified gem',
            'desc' => 'Unidentified red glowing gem',
            'character_id' => 1,
        ]);

        \App\Models\Item::create([
            'name' => 'Swift boots',
            'desc' => '+3m move range, light armor',
            'character_id' => 2,
        ]);
        
        \App\Models\Item::create([
            'name' => 'Potion of invisibility',
            'desc' => 'Lasts 10 rounds, effects stops early if attacking or casting a spell',
            'character_id' => 3,
        ]);

        \App\Models\Item::create([
            'name' => 'Strange stone key',
            'desc' => 'Big key sculpted in stone, vibrating with magic energy',
            'character_id' => 5,
        ]);

        \App\Models\Item::create([
            'name' => 'Fire mace of Sigmar',
            'desc' => 'Embued with fire, +5 CC, Cleric weapon',
            'character_id' => 5,
        ]);

        \App\Models\Item::create([
            'name' => 'Scroll of Resurrection',
            'desc' => 'Make a dead ally come back to life with only 1 health point',
            'character_id' => 6,
        ]);
        
        \App\Models\Item::create([
            'name' => 'Scroll of Resurrection',
            'desc' => 'Make a dead ally come back to life with only 1 health point',
            'character_id' => 2,
        ]);

        \App\Models\Item::create([
            'name' => 'Scroll of Resurrection',
            'desc' => 'Make a dead ally come back to life with only 1 health point',
            'character_id' => 5,
        ]);

        \App\Models\Item::create([
            'name' => 'Scroll of Resurrection',
            'desc' => 'Make a dead ally come back to life with only 1 health point',
            'character_id' => 7,
        ]);

        \App\Models\Item::create([
            'name' => 'Scroll of Resurrection',
            'desc' => 'Make a dead ally come back to life with only 1 health point',
            'character_id' => 9,
        ]);


        \App\Models\Item::create([
            'name' => 'Locked book',
            'desc' => 'Unknown book with a golden lock, embued with dark magic',
            'character_id' => 7,
        ]);
        
        \App\Models\Item::create([
            'name' => 'Scroll of Fireball',
            'desc' => 'Throw a giant fireball making 3d10 fire damage, 18m range, 1.5m radius',
            'character_id' => 8,
        ]);

        \App\Models\Item::create([
            'name' => 'Ring of strength',
            'desc' => 'A dwarf forged ring enchanted with runes, grants +1 strength',
            'character_id' => 9,
        ]);

        \App\Models\Item::create([
            'name' => 'Thief Prince dagger',
            'desc' => 'Old but legendary dagger, +2d10 damage if target is hit without seeing you',
            'character_id' => 10,
        ]);

        \App\Models\Item::create([
            'name' => 'Crown of wisdom',
            'desc' => 'Thin plant themed crown, grants +1 intelligence',
            'character_id' => 11,
        ]);

        $heal = \App\Models\Spell::create([
            'name' => 'Healing prayer',
            'desc' => 'gives 1d10 hp to a creature',
        ]);
        $shock = \App\Models\Spell::create([
            'name' => 'Ground Shock',
            'desc' => 'Hit the ground and deal 2d8 damage up to 3m around you. stuns enemy that are less than 1m away from you.',
        ]);
        $larandel->spells()->attach($heal);
        $larandel->spells()->attach($shock);

        $fireball = \App\Models\Spell::create([
            'name' => 'Fireball',
            'desc' => 'Throw a giant fireball making 3d10 fire damage, 18m range, 1.5m radius',
        ]);
        $sunbringer->spells()->attach($fireball);

        $magic_shield = \App\Models\Spell::create([
            'name' => 'Arcane Shield',
            'desc' => 'Reduces all incoming damage of a creature of 3 damage, 1m range, lasts 4 rounds',
        ]);
        $jan->spells()->attach($magic_shield);

        $sanctuary = \App\Models\Spell::create([
            'name' => 'Sanctuary',
            'desc' => 'Makes a creature unable to receive any damage but also unable to do any action. lasts 10 rounds',
        ]);
        $ultia->spells()->attach($sanctuary);

        \App\Models\GlobInfo::create([
            'info' => 'You were escorting priests, got ambushed by goblins and on of them fleed with the relic you were supposed to protect.',
            'table_id' => '1',
        ]);

        \App\Models\GlobInfo::create([
            'info' => 'Skavens have taken over Altdorf, and as far as you have seen, over pretty much everywhere.',
            'table_id' => '2',
        ]);

        \App\Models\DmInfo::create([
            'info' => 'Skaven leader have formed an alliance to take over the surface realms. They have succeeded and nothing can save the players. Its only a question of when will they die.',
            'table_id' => '2',
        ]);

        \App\Models\DmInfo::create([
            'info' => 'Players are followed by a group of skavens, waiting for the rest of their unit to join them and assault.',
            'table_id' => '2',
        ]);

        $sigmar_bless = \App\Models\Buff::create([
            'name' => 'Blessed by Sigmar',
            'desc' => '+1 strength, +1 endurance, unknown duration',
            'is_debuff' => '0',
        ]);
        $gundyr->buffs()->attach($sigmar_bless);
        $larandel->buffs()->attach($sigmar_bless);
        $sunbringer->buffs()->attach($sigmar_bless);

        $broken_finger = \App\Models\Buff::create([
            'name' => 'Broken finger',
            'desc' => '-10 dexterity and -10 strength to all tests requiring hands, until healed by a medecine test',
            'is_debuff' => '1',
        ]);
        $hugo->buffs()->attach($broken_finger);

        $hangover = \App\Models\Buff::create([
            'name' => 'Hangover',
            'desc' => '-10 to sociability tests, -5 to all others test, until rest',
            'is_debuff' => '1',
        ]);
        $gurk->buffs()->attach($hangover);
        $jan->buffs()->attach($hangover);

        $magic_luck = \App\Models\Buff::create([
            'name' => 'Lucky',
            'desc' => 'You can throw the dices again on any test of your choice, once per day, last 7 days',
            'is_debuff' => '2',
        ]);
        $ultia->buffs()->attach($magic_luck);

        \App\Models\CharInfo::create([
            'info' => 'Youre still looking for your brother who disappeared, last seen at the joyful crow inn on the road to Middenheim.',
            'character_id' => '1',
            'is_secret' => '0'
        ]);

        \App\Models\CharInfo::create([
            'info' => 'Your brother is a werewolf. But even though, its the first time he disappears like that.',
            'character_id' => '1',
            'is_secret' => '1'
        ]);

        \App\Models\CharInfo::create([
            'info' => 'You had a deal with a devil, who have the power to summon you whenever he needs, in order to save your home forest from destruction.',
            'character_id' => '3',
            'is_secret' => '1'
        ]);

        \App\Models\CharInfo::create([
            'info' => 'You left a family to the mercy of skavens in order to save your own life.',
            'character_id' => '2',
            'is_secret' => '1'
        ]);

        \App\Models\CharInfo::create([
            'info' => 'You know that skavens shouldnt be this organized. You also know that theyre making a lot of humans their slaves. A big lot.',
            'character_id' => '7',
            'is_secret' => '0'
        ]);

        \App\Models\CharInfo::create([
            'info' => 'You recently encountered a woman pretending to be from your family. You finally may not be the last.',
            'character_id' => '11',
            'is_secret' => '1'
        ]);
    }
}
