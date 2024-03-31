<?php

namespace App\Http\Resources;

use App\Http\Resources\Result\ResultResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->user->phone_number,
            'national_id' => $this->national_id,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'city' => $this->city,
            'address' => $this->address,
            'avatar' => $this->getFirstMediaUrl('avatars'),
            'reserves' => $this->when($this->reserves->isNotEmpty(), ReserveResource::collection($this->reserves)),
            'test_result' => $this->when($this->results->isNotEmpty(), ResultResource::collection($this->results)),
        ];
    }
}
