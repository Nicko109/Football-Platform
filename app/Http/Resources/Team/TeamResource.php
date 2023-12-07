<?php

namespace App\Http\Resources\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'points' => $this->points,
            'goalsAll' => $this->goalsAll(),
            'gamesTeamAll' => $this->gamesTeamAll(),
            'gamesOpponentAll' => $this->gamesOpponentAll(),
            'image' => $this->image,

        ];
    }
}
