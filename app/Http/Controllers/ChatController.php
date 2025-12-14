<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;

class ChatController extends Controller
{
    // ======================
    // ADMIN: LIST USER CHAT
    // ======================
    public function adminChatList()
    {
        $users = Message::whereNotNull('user_id')
            ->with('user')
            ->select('user_id')
            ->groupBy('user_id')
            ->get();

        return view('admin.chat-list', compact('users'));
    }

    // ======================
    // ADMIN: CHAT PER USER
    // ======================
    public function adminChatUser($user_id)
    {
        $messages = Message::where('user_id', $user_id)
            ->orderBy('created_at')
            ->get();

        return view('admin.chat', compact('messages', 'user_id'));
    }

    // ======================
    // USER SEND MESSAGE
    // ======================
    public function sendMessage(Request $request)
    {
        Message::create([
            'user_id'     => auth()->id(),
            'sender_role' => 'user',
            'message'     => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    // ======================
    // ADMIN SEND MESSAGE
    // ======================
    public function adminSend(Request $request, $user_id)
    {
        Message::create([
            'user_id'     => $user_id,
            'sender_role' => 'admin',
            'message'     => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    // ======================
    // LOAD CHAT USER (USER)
    // ======================
    public function getMessages()
    {
        return Message::where('user_id', auth()->id())
            ->orderBy('created_at')
            ->get();
    }
}
