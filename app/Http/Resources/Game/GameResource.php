<?php

namespace App\Http\Resources\Game;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'date' => $this->date,
            'score' => $this->score,
            'points' => $this->points,
            'win' => $this->win,
            'is_active' => $this->is_active,
        ];
    }
}
