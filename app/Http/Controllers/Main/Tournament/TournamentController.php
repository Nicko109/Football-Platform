<?php

namespace App\Http\Controllers\Main\Tournament;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->is_admin;
        $data = Team::orderByDesc('points')->paginate(6);
        $teams = $data->getCollection();
        $teams->each(function ($team) {
            $team->goalsAll = $team->goalsAll();
            $team->wins = $team->wins();
            $team->losses = $team->losses();
            $team->draws = $team->draws();
            $team->gamesTeamAll = $team->gamesTeamAll();
            $team->gamesOpponentAll = $team->gamesOpponentAll();
        });


        return inertia('Tournament/Index', [
            'teams' => $teams,
            'paginationLinks' => $data,
            'isAdmin' => $isAdmin
        ]);
    }
}
