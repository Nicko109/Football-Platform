<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;


    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function goalsInGame(Game $game)
    {
        return $this->goals()->where('game_id', $game->id)->sum('count');
    }

    public function goalsAll()
    {
        return $this->goals()->sum('count');
    }


}
