<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;



    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function goalsAll()
    {
        return $this->goals()->sum('count');
    }

}
