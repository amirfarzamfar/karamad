<?php

namespace App\Policies;

use App\Models\Ticket\Message;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Message $message): Response
    {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
            return Response::allow();
        }
        return $user->id == $message->chat->user_id
            ? Response::allow()
            : Response::denyAsNotFound('Message not found.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Message $message): Response
    {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
            return Response::allow();
        }
        return $user->id == $message->chat->user_id
            ? Response::allow()
            : Response::denyAsNotFound('Message not found.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Message $message): Response
    {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('user')) {
            return Response::allow();
        }
        return $user->id == $message->chat->user_id
            ? Response::allow()
            : Response::denyAsNotFound('Message not found.');
    }
}
