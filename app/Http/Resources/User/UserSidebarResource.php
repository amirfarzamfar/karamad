<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSidebarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ax = $this->getFirstMediaUrl('avatar');
        return [
            'id' => $this->id,
            'phone_number' => $this->phone_number,
            'name' => $this->name,
            'family' => $this->family,
            'email' => $this->email,
//            'avatar'=>  $this->when($this->getFirstMediaUrl('avatar') !=null , $this->getFirstMediaUrl('avatar')),
            'avatar'=>  $this->getFirstMediaUrl('avatar')

            ];
    }
}
