<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\StoreMessageRequest;
use App\Http\Requests\Ticket\UpdateMessageRequest;
use App\Http\Resources\ticket\MessageResource;
use App\Models\Ticket\Chat;
use App\Models\Ticket\Message;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{


    public function store(StoreMessageRequest $request)
    {

        $admin = Auth::user()->hasRole('admin');
        if ($admin) {
            $admin_id = Auth::user()->id;
            $chat = Chat::where('id',$request->input('chat_id'))->first();
            $chat->update(['admin_id'=>$admin_id]);
            $chat->save();
        }

        $message = Message::create([
            'chat_id' => $request->input('chat_id'),
            'sender' => auth()->user()->getRoleNames()[0],
            'message' => $request->input('message'),
        ]);
        return MessageResource::make($message);
    }




    public function update(UpdateMessageRequest $request, Message $message)
    {
        $this->authorize('update', $message);
        $message->update([
            'message' => $request->input('message')
        ]);
        return MessageResource::make($message);
    }


    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return response()->json([
            'message' => 'Message deleted.'
        ]);
    }


    public function mark_as_seen(Message $message)
    {

        $this->authorize('view', $message);
        $message->seen = true;
        $message->save();
        return response()->noContent();
    }
}
