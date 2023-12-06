<?php

namespace App\Http\Controllers\Admin\Player;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Http\Requests\Player\StorePlayerRequest;
use App\Http\Requests\Player\UpdatePlayerRequest;
use App\Services\PlayerService;
use Mockery\Matcher\Not;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = PlayerService::index();

        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();

        $player = PlayerService::store($data);

        return redirect()->route('admin.players.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        $teams = $player->teams()->get();
        return view('players.show', compact('player', 'teams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $data = $request->validated();
        PlayerService::update($player, $data);

        return redirect()->route('admin.players.show', compact('player'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        PlayerService::destroy($player);

        return redirect()->route('admin.players.index');

    }
}
