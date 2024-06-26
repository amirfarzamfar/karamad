<?php

namespace App\Http\Resources\User;

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
            'phone_number' => $this->phone_number,
            'name' => $this->name,
            'family' => $this->family,
            'national_id' => $this->national_id,
            'avatar' => $this->getFirstMediaUrl('avatar'),
            'role' => $this->getRoleNames()
        ];
    }
}
