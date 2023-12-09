<?php

namespace App\Http\Controllers\Main\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameResource;
use App\Http\Resources\Player\PlayerResource;
use App\Models\Game;
use App\Models\Note;
use App\Models\Player;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use App\Services\TeamService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Game $game)
    {
        $isAdmin = auth()->user()->is_admin;

        $games = Game::with(['team', 'opponent'])->orderBy('date')->get();

        $games->each(function ($game) {
            $game->formattedDate = $game->getFormattedDateAttribute();
            $game->teamGoalsCount = $game->teamGoalsCount();
            $game->opponentGoalsCount = $game->opponentGoalsCount();
            $game->winner = $game->getWinAttribute();
        });


        return inertia('Game/Index', compact('isAdmin', 'games'));
    }

    public function show(Game $game)
    {
        $isAdmin = auth()->user()->is_admin;

        $game->formattedDate = $game->getFormattedDateAttribute();
        $game->teamGoalsCount = $game->teamGoalsCount();
        $game->opponentGoalsCount = $game->opponentGoalsCount();
        $game->winner = $game->getWinAttribute();


        $teamPlayers = $game->team->players->map(function($player) use ($game) {
            $player->goalsInGame = $player->goalsInGame($game);
            return $player;
        })->filter(function($player) {
            return $player->goalsInGame > 0;
        });

        $opponentPlayers = $game->opponent->players->map(function($player) use ($game) {
            $player->goalsInGame = $player->goalsInGame($game);
            return $player;
        })->filter(function($player) {
            return $player->goalsInGame > 0;
        });

        return inertia('Game/Show', compact('game', 'isAdmin', 'teamPlayers', 'opponentPlayers'));
    }
}
