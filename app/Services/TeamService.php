<?php

namespace App\Services;


use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    public static function index()
    {
        $teams = Team::paginate(15);


        return $teams;
    }


    public static function store(array $data) : Team
    {
        $team = Team::create(['title' => $data['title']]);

        // Синхронизируем выбранных игроков с командой
        if (!empty($data['player_id'])) {
            $players = Player::whereIn('id', $data['player_id'])->where('is_active', false)->get();
            $team->players()->syncWithoutDetaching($players->pluck('id')->toArray());

            // Обновляем статус игроков
            $players->each(function ($player) {
                $player->update(['is_active' => true]);
            });
        }

        return $team;
    }

    public static function show(Team $team)
    {

        return $team;
    }



    public static function update(Team $team, array $data, array $previousPlayerIds)
    {
        $team->update(['title' => $data['title']]);
        $removedPlayerIds = array_diff($previousPlayerIds, $data['player_id']);

        Player::whereIn('id', $removedPlayerIds)->update(['is_active' => false]);
        $team->players()->sync($data['player_id']);

        $players = Player::whereIn('id', $data['player_id'])->where('is_active', false)->get();
        $players->each(function ($player) {
            $player->update(['is_active' => true]);
        });


        return $team;
    }

    public static function destroy(Team $team)
    {
        return $team->delete();
    }
}
