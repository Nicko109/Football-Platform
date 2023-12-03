<?php

namespace App\Services;


use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    public static function index()
    {
        $teams = Team::latest()->get();

        return $teams;
    }




    public static function store(array $data) : Team
    {
        return Team::create($data);
    }

    public static function show(Team $team)
    {

        return $team;
    }



    public static function update(Team $team, array $data)
    {

        return $team->update($data);
    }

    public static function destroy(Team $team)
    {
        return $team->delete();
    }
}
