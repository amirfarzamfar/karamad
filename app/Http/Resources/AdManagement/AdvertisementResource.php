<?php

namespace App\Http\Resources\AdManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            'gender' => $this->gender,
            'military_exemption' => $this->military_exemption,
            'type_of_cooperation' => $this->type_of_cooperation,
            'salary' => $this->salary,
            'city_province' => $this->city_province,
            'degree_of_education' => $this->degree_of_education,
            'address' => $this->address,
            'about' => $this->about,
            'organization_id' => $this->organization_id,
            'status' => $this->status,

        ];
    }
}
