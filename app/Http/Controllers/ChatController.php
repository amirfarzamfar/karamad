<?php

namespace App\Http\Controllers;


use App\Http\Resources\ticket\ChatResource;
use App\Models\Ticket\Chat;



class ChatController extends Controller
{

    public function index()
    {
        return ChatResource::collection(Chat::all());
    }


    public function store()
    {
        if ((bool)auth()->user()->chat) {
            return response()->json([
                'chat_id' => auth()->user()->chat->id
            ]);
        } else {
            $chat = Chat::create([
                'user_id' => auth()->user()->id
            ]);
            return response()->json([
                'chat_id' => $chat->id
            ]);
        }
    }


    public function show(Chat $chat)
    {
        $this->authorize('view', $chat);
        return ChatResource::make($chat);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Endpoint("Delete a chat", "From here you can delete a chat.")]
    #[UrlParam(name: "chat_id", type: "int", description: "The id of existing chat", required: true, example: 5)]
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response()->json([
            'message' => 'Chat deleted.'
        ]);
    }
}
