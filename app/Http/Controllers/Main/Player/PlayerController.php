<?php

namespace App\Http\Controllers\Main\Player;

use App\Http\Controllers\Controller;
use App\Http\Resources\Player\PlayerResource;
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
        $this->authorize('viewAny', Player::class);
        $isAdmin = auth()->user()->is_admin;
        $players = Player::with('teams')->orderBy('name')->get();

        $players->each(function ($player) {
            $player->goalsAll = $player->goalsAll();
        });


        return inertia('Player/Index', compact('players', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Player::class);
        return inertia('Player/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $this->authorize('create', Player::class);
        $data = $request->validated();

        $player = PlayerService::store($data);

        return redirect()->route('players.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        $this->authorize('view', $player);
        $player = PlayerService::show($player);

        $player = PlayerResource::make($player)->resolve();

        $isAdmin = auth()->user()->is_admin;


        return inertia('Player/Show', compact('player', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        $this->authorize('update', $player);
        $player = PlayerResource::make($player)->resolve();
        return inertia('Player/Edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $this->authorize('update', $player);
        $data = $request->validated();
        PlayerService::update($player, $data);

        return redirect()->route('players.show', compact('player'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $this->authorize('delete', $player);
        PlayerService::destroy($player);

        return redirect()->route('players.index');

    }

}
