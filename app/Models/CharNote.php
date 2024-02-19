<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'note',
        'character_id'
    ];

    /**
     * The character that owns the note.
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
