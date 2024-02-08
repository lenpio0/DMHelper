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
        'health',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The user that owns the character.
     */
    public function user()
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * The character infos that belong to the character.
     */
    public function charInfos()
    {
        return $this->hasMany(CharInfo::class);
    }

}
