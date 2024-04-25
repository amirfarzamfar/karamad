<?php

namespace App\Http\Resources\ticket;

use App\Http\Resources\ticket\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'chat_id' => $this->id,
            'user_phone_number'=> $this->user->phone_number,
            'messages' => MessageResource::collection($this->messages)
        ];
    }
}
