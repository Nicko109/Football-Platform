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


    public static function store(array $data): Game
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
            $game->win = $game->team_id;
            $game->lose = $game->opponent_id;
            $game->team->points += 3;
        } elseif ($game->teamGoalsCount() < $game->opponentGoalsCount()) {
            $game->lose = $game->team_id;
            $game->win = $game->opponent_id;
            $game->opponent->points += 3;
        } else {
            $game->draw = 'draw';
            $game->team->points += 1;
            $game->opponent->points += 1;
        }

        $game->fill($data);
        $game->is_active = true;
        $game->team->save();
        $game->opponent->save();
        $game->save();


        return $game;
    }

    public static function destroy(Game $game)
    {
        return $game->delete();
    }


    public static function updateDetails(Game $game, array $data)
    {
        return $game->update($data);
    }


}
