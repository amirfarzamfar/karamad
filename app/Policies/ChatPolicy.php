<?php

namespace App\Policies;

use App\Models\Ticket\Chat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChatPolicy
{


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chat $chat): Response
    {
        return $user->id == $chat->user_id
            ? Response::allow()
            : Response::denyAsNotFound('Chat not found');
    }
}
