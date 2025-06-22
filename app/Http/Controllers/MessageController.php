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
            'item_id' => 'nullable|exists:items,id',
        ]);

        $messageText = $validated['message'];

        // If this message is about a specific item, add context
        if (isset($validated['item_id'])) {
            $item = \App\Models\Item::find($validated['item_id']);
            if ($item) {
                $messageText = "Concernant l'article '{$item->title}': " . $messageText;
            }
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $messageText,
        ]);

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Message envoyé avec succès']);
        }

        return redirect()->route('messages.index')->with('success', 'Message envoyé');
    }
}

