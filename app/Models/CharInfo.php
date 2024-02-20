<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharInfo extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'info',
        'is_secret',
        'character_id',
    ];

    /**
     * The character that owns the info.
     */
    public function character()
    {
        return $this->belongsTo(Character::class);
    }

}
