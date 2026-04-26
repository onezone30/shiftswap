<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'branch'   => $this->whenLoaded('branch', fn() => [
                'id'   => $this->branch->id,
                'name' => $this->branch->name,
            ]),
            'position' => $this->whenLoaded('position', fn() => [
                'id'   => $this->position->id,
                'name' => $this->position->name,
            ]),
            'role' => $this->role,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
