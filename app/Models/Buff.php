<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'desc',
        'is_debuff',
    ];

    /**
     * The characters that takes the debuff.
     */
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
