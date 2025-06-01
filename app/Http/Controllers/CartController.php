<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher les articles du panier
    public function index()
{
    $cartItems = session()->get('cart', []);
    $total = 0;

    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    $shipping = 1000; // Par exemple : 5€ de livraison

    $grandTotal = $total + $shipping;

    return view('shoping-cart', compact('cartItems', 'total', 'shipping', 'grandTotal'));
}


    // Ajouter un article au panier
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $cart[$request->item_id] = $request->quantity;
        session()->put('cart', $cart);

        return redirect()->route('shopping-cart')->with('success', 'Article ajouté au panier!');
    }

    // Supprimer un article du panier
    public function destroy($itemId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('shopping-cart')->with('success', 'Article retiré du panier!');
    }
    public function show ($itemId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$itemId])) {
            return redirect()->route('shopping-cart')->with('error', 'Article non trouvé dans le panier.');
        }

        // Si tu veux juste la quantité :
        $quantity = $cart[$itemId];

        // Si tu veux aussi récupérer les infos depuis la base :
        $item = \App\Models\Item::find($itemId);

        if (!$item) {
            return redirect()->route('shopping-cart')->with('error', 'Article inexistant.');
        }

        return view('index', compact('item', 'quantity'));
    }


    // Vider complètement le panier
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('shopping-cart')->with('success', 'Panier vidé!');
    }
}

