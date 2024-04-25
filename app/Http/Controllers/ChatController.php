<?php

namespace App\Http\Controllers;


use App\Http\Resources\ticket\ChatResource;
use App\Models\Ticket\Chat;
use Illuminate\Http\Request;


class ChatController extends Controller
{

    public function index()
    {
        return ChatResource::collection(Chat::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
        ]);


        if ((bool)auth()->user()->chat) {
            return response()->json([
                'chat_id' => auth()->user()->chat->id
            ]);
        } else {
            $chat = Chat::create([
                'user_id' => auth()->user()->id,
                 'subject' => $request->input('subject')
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



    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response()->json([
            'message' => 'Chat deleted.'
        ]);
    }
}
