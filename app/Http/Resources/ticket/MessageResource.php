<?php

namespace App\Http\Resources\ticket;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class   MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->id,
            'sender' => $this->sender,
            'message' => $this->message,
            'seen' => (bool)$this->seen,
            'send_at' => Carbon::create($this->created_at)->format('Y/m/d H:i:s')
        ];
    }
}
