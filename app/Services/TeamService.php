<?php

namespace App\Services;


use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamService
{
    public static function index()
    {
        $teams = Team::all()->sortByDesc('points');


        return $teams;
    }


    public static function store(array $data) : Team
    {

        if (isset($data['image'])) {
            $imagePath = Storage::disk('public')->put('team', $data['image']);
            $data['image'] = Storage::disk('public')->url($imagePath);
        }
        $team = Team::create([
            'title' => $data['title'],
            'image' => $data['image'] ?? null,
        ]);

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
        $team->players->each(function ($player) {
        $player->update(['is_active' => false]);
    });

        return $team->delete();
    }


    public static function updateImage(Team $team, array $data)
    {

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {

            Storage::disk('public')->delete($team->image);

            $path = Storage::disk('public')->put('team', $data['image']);
            $fullPath = Storage::disk('public')->url($path);
            $team->update(['image' => $fullPath]);
        }

        // Не возвращаем данные в этом методе
    }
}
