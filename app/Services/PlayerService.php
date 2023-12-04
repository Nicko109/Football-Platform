<?php

namespace App\Services;


use App\Models\Player;
use Illuminate\Support\Facades\Auth;

class PlayerService
{
    public static function index()
    {
        $players = Player::latest()->get();

        return $players;
    }




    public static function store(array $data) : Player
    {
        return Player::create($data);
    }

    public static function show(Player $player)
    {

        return $player;
    }



    public static function update(Player $player, array $data)
    {

        return $player->update($data);
    }

    public static function destroy(Player $player)
    {
        return $player->delete();
    }
}
