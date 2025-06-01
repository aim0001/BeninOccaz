<?php

namespace App\Http\Controllers;

use App\Models\FeaturedItem;
use App\Models\Item;
use Illuminate\Http\Request;

class FeaturedItemController extends Controller
{
    public function index()
    {
        $featuredItems = FeaturedItem::with('item')->get();
        return view('admin.featured_items', compact('featuredItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'is_active' => 'boolean',
        ]);

        FeaturedItem::updateOrCreate(['item_id' => $validated['item_id']], ['is_active' => $validated['is_active']]);

        return redirect()->back()->with('success', 'Article mis en avant !');
    }

    public function destroy(FeaturedItem $featuredItem)
    {
        $featuredItem->delete();
        return redirect()->back()->with('success', 'Article retiré de la fil d’actualité !');
    }
}
