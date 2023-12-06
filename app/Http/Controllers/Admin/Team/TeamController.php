<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use App\Services\TeamService;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = TeamService::index();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = Player::where('is_active', false)->get();

        return view('teams.create', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();

        $team = TeamService::store($data);

        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {

        $players = $team->players()->get();
        return view('teams.show', compact('team', 'players'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        // Получаем список всех игроков и идентификаторы игроков команды
        $allPlayers = Player::all();
        $teamPlayerIds = $team->players->pluck('id')->toArray();

        // Получаем список неактивных игроков и идентификаторы
        $inactivePlayers = Player::where('is_active', false)->get();

        return view('teams.edit', compact('team', 'allPlayers', 'teamPlayerIds', 'inactivePlayers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data = $request->validated();
        $previousPlayerIds = $team->players->pluck('id')->toArray();
        TeamService::update($team, $data, $previousPlayerIds);

        return redirect()->route('admin.teams.show', compact('team'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        TeamService::destroy($team);

        return redirect()->route('admin.teams.index');

    }
}
