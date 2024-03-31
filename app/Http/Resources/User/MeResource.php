<?php

namespace App\Http\Resources\User;

use App\Http\Resources\DocumentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "role" => $this->getRoleNames(),
            "user" => [
                "id" => $this->id,
                "phone_number" => $this->phone_number,
                "national_id" => $this->when($this->national_id != null, $this->national_id),
                "name" => $this->when($this->name != null, $this->name),
                "family" => $this->when($this->family != null, $this->family),
                "avatar" => $this->getFirstMediaUrl('avatar')
            ],
            "document" => $this->when($this->hasRole('user'), DocumentResource::collection($this->documents)),
        ];
    }
}
