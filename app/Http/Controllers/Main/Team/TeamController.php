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
        $data = Team::paginate(3);
        $isAdmin = auth()->user()->is_admin;

        $teams = $data->getCollection();


        return inertia('Team/Index',  [
            'teams' => $teams,
            'paginationLinks' => $data,
            'isAdmin' => $isAdmin
        ]);
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
