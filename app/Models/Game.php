<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function opponent()
    {
        return $this->belongsTo(Team::class, 'opponent_id');
    }

    public function getWinAttribute()
    {
        $team = Team::find($this->attributes['win']); // Предполагаем, что 'win' хранит team_id победителя
        if ($team) {
            return $team->title;
        } else {
            return 'Ничья'; // Если 'win' не содержит team_id
        }
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function teamGoalsCount()
    {
        return $this->goals()->where('team_id', $this->team_id)->sum('count');
    }

    public function opponentGoalsCount()
    {
        return $this->goals()->where('team_id', $this->opponent_id)->sum('count');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d.m.y H:i');
    }
}
