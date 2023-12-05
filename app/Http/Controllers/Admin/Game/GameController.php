<?php

namespace App\Http\Controllers\Admin\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\UpdateGameDetailsRequest;
use App\Models\Game;
use App\Http\Requests\Game\StoreGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Models\Team;
use App\Services\GameService;
use Mockery\Matcher\Not;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = GameService::index();

        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Game $game)
    {
        $teams = Team::all();


        return view('games.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        $data = $request->validated();

        $game = GameService::store($data);

        $game->save();

        return redirect()->route('admin.games.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $teams = Team::all();
        return view('games.edit', compact('game', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $data = $request->validated();
        $goals = $request->input('goals', []);
        GameService::update($game, $data, $goals);
        return redirect()->route('admin.games.show', compact('game'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        GameService::destroy($game);

        return redirect()->route('admin.games.index');

    }

    public function editDetails(Game $game)
    {
        $teams = Team::all();
        return view('games.edit-details', compact('game', 'teams'));
    }

    public function updateDetails(UpdateGameDetailsRequest $request, Game $game)
    {
        $data = $request->validated();

        GameService::updateDetails($game, $data);

        return redirect()->route('admin.games.show', compact('game'));
    }
}
