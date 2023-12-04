<?php

namespace App\Services;


use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameService
{
    public static function index()
    {
        $games = Game::paginate(15);

        return $games;
    }




    public static function store(array $data, $winningTeamId = null) : Game
    {
        $game = Game::create($data);

        // Добавляем информацию о победителе, если она предоставлена
        if (!is_null($winningTeamId)) {
            $game->update(['win' => $winningTeamId]);
        }

        return $game;
    }

    public static function show(Game $game)
    {

        return $game;
    }



    public static function update(Game $game, array $data)
    {
        $teamId = $game->team_id;
        $opponentId = $game->opponent_id;

        $winningTeamId = null;
        if ($data['win'] == 'team_id') {
            $winningTeamId = $teamId;
        } elseif ($data['win'] == 'opponent_id') {
            $winningTeamId = $opponentId;
        }

        $game->fill($data);

        if (!is_null($winningTeamId)) {
            $game->win = $winningTeamId;
        }

        $game->save();

        return $game;
    }

    public static function destroy(Game $game)
    {
        return $game->delete();
    }
}
