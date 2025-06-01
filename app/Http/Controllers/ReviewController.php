<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Afficher les avis d’un produit
    public function index($itemId)
    {
        $reviews = Review::where('item_id', $itemId)->latest()->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    // Publier un avis
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'item_id' => $validated['item_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('reviews.index', $validated['item_id'])->with('success', 'Avis publié');
    }
}
