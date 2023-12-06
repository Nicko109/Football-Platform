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
        $game->is_active = true;
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


        if ($game->teamGoalsCount() > $game->opponentGoalsCount()) {
            $game->team->points += 3;
        } elseif ($game->teamGoalsCount() < $game->opponentGoalsCount()) {
            $game->opponent->points += 3;
        } else {
            $game->team->points += 1;
            $game->opponent->points += 1;
        }

        $game->team->save();
        $game->opponent->save();


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
