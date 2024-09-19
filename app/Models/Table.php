<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id'
    ];
 
    /**
     * The characters that are on the table.
     */
    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    /**
     * The dm infos that belong to the table.
     */
    public function dmInfos()
    {
        return $this->hasMany(DmInfo::class);
    }

    /**
     * The global infos that belong to the table.
     */
    public function globInfos()
    {
        return $this->hasMany(GlobInfo::class);
    }

       /**
     * The user that owns the table.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
