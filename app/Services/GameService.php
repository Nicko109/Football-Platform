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




    public static function store(array $data) : Game
    {
        $game = Game::create($data);


        return $game;
    }

    public static function show(Game $game)
    {

        return $game;
    }



    public static function update(Game $game, array $data, array $goals)
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
            $game->is_active = true; // Устанавливаем is_active в true, если есть победитель
        } else {
            $game->is_active = false; // Если нет победителя, то матч неактивен
        }

        $game->save();


        foreach ($goals as $teamId => $teamGoals) {
            foreach ($teamGoals as $playerId => $goalCount) {
                // Создаем или обновляем гол только для указанной команды
                \App\Models\Goal::updateOrCreate(
                    ['game_id' => $game->id, 'player_id' => $playerId, 'team_id' => $teamId],
                    ['count' => $goalCount]
                );
            }
        }

        foreach ($goals as $opponentId => $teamGoals) {
            foreach ($teamGoals as $playerId => $goalCount) {
                // Создаем или обновляем гол только для указанной команды
                \App\Models\Goal::updateOrCreate(
                    ['game_id' => $game->id, 'player_id' => $playerId, 'team_id' => $opponentId],
                    ['count' => $goalCount]
                );
            }
        }


        return $game;
    }

    public static function destroy(Game $game)
    {
        $game->goals()->delete();
        foreach ($game->team->players as $player) {
            $player->goals()->where('game_id', $game->id)->delete();
        }

        foreach ($game->opponent->players as $player) {
            $player->goals()->where('game_id', $game->id)->delete();
        }

        // Обновляем статистику для каждой команды
        $game->team->goals()->where('game_id', $game->id)->delete();
        $game->opponent->goals()->where('game_id', $game->id)->delete();
        return $game->delete();
    }


    public static function updateDetails(Game $game, array $data)
    {
        // Удаляем все голы для данной игры
        $game->goals()->delete();

        // Обновляем статус игры
        $game->is_active = false;
        $game->update($data);

        // Удаляем голы и обновляем статистику для каждого игрока
        foreach ($game->team->players as $player) {
            $player->goals()->where('game_id', $game->id)->delete();
        }

        foreach ($game->opponent->players as $player) {
            $player->goals()->where('game_id', $game->id)->delete();
        }

        // Обновляем статистику для каждой команды
        $game->team->goals()->where('game_id', $game->id)->delete();
        $game->opponent->goals()->where('game_id', $game->id)->delete();

        return $game;
    }
}
