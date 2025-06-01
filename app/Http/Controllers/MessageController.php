<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Afficher les conversations de l’utilisateur
    public function index()
    {
        $messages = Auth::user()->messages()->latest()->paginate(10);
        return view('messages.index', compact('messages'));
    }

    // Envoyer un message
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('messages.index')->with('success', 'Message envoyé');
    }
}

