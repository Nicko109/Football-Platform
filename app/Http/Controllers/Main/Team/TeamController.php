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


        return inertia('Team/Index', compact('isAdmin', 'teams'));
    }

    public function show(Team $team)
    {

        $isAdmin = auth()->user()->is_admin;
        $players = $team->players()->get();
        $players->each(function ($player) {
            $player->goalsAll = $player->goalsAll();
        });
        return inertia('Team/Show', compact('team', 'isAdmin', 'players'));
    }
}
