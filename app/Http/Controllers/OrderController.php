<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Afficher les commandes d’un utilisateur
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Valider une commande
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'item_id' => $validated['item_id'],
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Commande validée');
    }
}
