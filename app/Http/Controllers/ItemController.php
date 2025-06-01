<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function latest()
{
    $items = Item::latest()->limit(10)->get(); // Récupère les 10 derniers articles
    return view('index', compact('items'));
}

    public function index()
    {
         $items = Item::available()

            ->with('user')
            ->latest()
            ->paginate(12);

        return view('product', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create', [
            'conditions' => Item::CONDITIONS,
            'deliveryMethods' => Item::DELIVERY_METHODS
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'condition' => 'required|in:' . implode(',', array_keys(Item::CONDITIONS)),
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delivery_method' => 'required|in:' . implode(',', array_keys(Item::DELIVERY_METHODS)),
            'meetup_location' => 'nullable|string|max:255'
            
        ]);

        // Traitement des images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/items');
                $imagePaths[] = Str::replaceFirst('public/', '', $path);
            }
        }

        // Création de l'annonce
        $item = Item::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'condition' => $validated['condition'],
            'images' => $imagePaths,
            'delivery_method' => $validated['delivery_method'],
            'meetup_location' => $validated['meetup_location'] ?? null,
        ]);

        return redirect()->route('items.show', $item)->with('success', 'Annonce créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('product-detail', [
            'item' => $item->load('user'),
            'similarItems' => Item::available()
                                ->where('category', $item->category)
                                ->where('id', '!=', $item->id)
                                ->inRandomOrder()
                                ->limit(4)
                                ->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        return view('form-edit', [
            'item' => $item,
            'conditions' => Item::CONDITIONS,
            'deliveryMethods' => Item::DELIVERY_METHODS
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'condition' => 'required|in:' . implode(',', array_keys(Item::CONDITIONS)),
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delivery_method' => 'required|in:' . implode(',', array_keys(Item::DELIVERY_METHODS)),
            'meetup_location' => 'nullable|string|max:255',
            'remove_images' => 'nullable|array'
        ]);

        // Gestion des images
        $currentImages = $item->images ?? [];
        
        // Suppression des images sélectionnées
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                if (($key = array_search($imageToRemove, $currentImages)) !== false) {
                    Storage::delete('public/' . $imageToRemove);
                    unset($currentImages[$key]);
                }
            }
            $currentImages = array_values($currentImages); // Réindexer le tableau
        }

        // Ajout des nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/items');
                $currentImages[] = Str::replaceFirst('public/', '', $path);
            }
        }

        // Limiter à 5 images maximum
        $currentImages = array_slice($currentImages, 0, 5);

        // Mise à jour de l'annonce
        $item->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'condition' => $validated['condition'],
            'images' => $currentImages,
            'delivery_method' => $validated['delivery_method'],
            'meetup_location' => $validated['meetup_location'] ?? null,
        ]);

        return redirect()->route('items.show', $item)->with('success', 'Annonce mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        // Supprimer les images associées
        if ($item->images) {
            foreach ($item->images as $image) {
                Storage::delete('public/' . $image);
            }
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Annonce supprimée avec succès!');
    }
}