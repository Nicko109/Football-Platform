<?php

namespace App\Http\Controllers\Main\Team;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->is_admin;

        $teams = Team::all()->sortByDesc('points')->values();
        $teams->each(function ($team) {
            $team->goalsAll = $team->goalsAll();
            $team->wins = $team->wins();
            $team->losses = $team->losses();
            $team->draws = $team->draws();
            $team->gamesTeamAll = $team->gamesTeamAll();
            $team->gamesOpponentAll = $team->gamesOpponentAll();
        });


        return inertia('Team/Index', compact('isAdmin', 'teams'));
    }

    public function show(Team $team)
    {


        return inertia('Team/Show', compact('team'));
    }
}
