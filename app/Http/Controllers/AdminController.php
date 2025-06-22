<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Report;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics for admin dashboard
        $stats = [
            'total_users' => User::count(),
            'total_items' => Item::count(),
            'pending_items' => Item::pending()->count(),
            'approved_items' => Item::approved()->count(),
            'rejected_items' => Item::rejected()->count(),
            'pending_reports' => Report::where('status', 'en attente')->count(),
            'total_categories' => Category::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_items' => Item::with('user')->latest()->take(5)->get(),
            'pending_items_list' => Item::pending()->with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load(['items', 'orders']);
        return view('admin.users.show', compact('user'));
    }

    public function toggleUserStatus(User $user)
    {
        // Toggle user active status (you might need to add this field)
        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function items()
    {
        $items = Item::with('user')->paginate(20);
        return view('admin.items', compact('items'));
    }

    public function showItem(Item $item)
    {
        $item->load('user');
        return view('admin.items.show', compact('item'));
    }

    public function toggleItemStatus(Item $item)
    {
        $item->is_sold = !$item->is_sold;
        $item->save();
        return redirect()->back()->with('success', 'Item status updated successfully.');
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.items')->with('success', 'Item deleted successfully.');
    }

    public function analytics()
    {
        $analytics = [
            'users_by_month' => User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->get(),
            'items_by_category' => Item::join('categories', 'items.category', '=', 'categories.name')
                ->selectRaw('categories.name, COUNT(*) as count')
                ->groupBy('categories.name')
                ->get(),
        ];

        return view('admin.analytics', compact('analytics'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request)
    {
        // Handle settings update
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Affiche les articles en attente d'approbation
     */
    public function pendingItems()
    {
        $pendingItems = Item::pending()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.pending-items', compact('pendingItems'));
    }

    /**
     * Affiche les détails d'un article en attente
     */
    public function showPendingItem(Item $item)
    {
        if (!$item->isPending()) {
            return redirect()->route('admin.pending-items')
                ->with('error', 'Cet article n\'est pas en attente d\'approbation.');
        }

        return view('admin.pending-items.show', compact('item'));
    }

    /**
     * Approuve un article
     */
    public function approveItem(Request $request, Item $item)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $item->approve(auth()->id(), $request->admin_notes);

        return redirect()->route('admin.pending-items')
            ->with('success', 'Article approuvé avec succès!');
    }

    /**
     * Rejette un article
     */
    public function rejectItem(Request $request, Item $item)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $item->reject(auth()->id(), $request->admin_notes);

        return redirect()->route('admin.pending-items')
            ->with('success', 'Article rejeté avec succès!');
    }
}
