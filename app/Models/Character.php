<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'max_health',
        'act_health',
        'user_id',
    ];

    /**
     * The user that owns the character.
     */
    public function user()
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * The character infos.
     */
    public function charInfos()
    {
        return $this->hasMany(CharInfo::class);
    }

    /**
     * The character notes.
     */
    public function charNotes()
    {
        return $this->hasMany(CharNote::class);
    }

    /**
     * The tables of the character.
     */
    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }

    /**
     * The buffs of the character.
     */
    public function buffs()
    {
        return $this->belongsToMany(Buff::class);
    }

    /**
     * The spells of the character.
     */
    public function spells()
    {
        return $this->belongsToMany(Spell::class);
    }

    /**
     * The items that belong to the character.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
