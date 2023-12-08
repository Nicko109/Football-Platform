<?php

namespace App\Http\Controllers\Main\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\GameResource;
use App\Http\Resources\Player\PlayerResource;
use App\Models\Game;
use App\Models\Note;
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

        $games = Game::with(['team', 'opponent'])->get();

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

        $teamPlayers = $game->team->players()->whereHas('goals', function ($query) use ($game) {
            $query->where('game_id', $game->id);
        })->get();

        $opponentPlayers = $game->opponent->players()->whereHas('goals', function ($query) use ($game) {
            $query->where('game_id', $game->id);
        })->get();

        // Измененное условие наличия голов в игре
        $teamPlayers = $teamPlayers->filter(function ($player) {
            return $player->goals->count() > 0;
        });

        $opponentPlayers = $opponentPlayers->filter(function ($player) {
            return $player->goals->count() > 0;
        });

        return inertia('Game/Show', compact('game', 'isAdmin', 'teamPlayers', 'opponentPlayers'));
    }
}
