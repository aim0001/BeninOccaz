<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Afficher la liste des signalements (Admin).
     */
    public function index()
    {
        $reports = Report::with('reporter', 'reported')->orderBy('created_at', 'desc')->get();
        return response()->json($reports);
    }

    /**
     * Créer un nouveau signalement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reporter_id' => 'required|exists:users,id',
            'reported_id' => 'required|exists:users,id',
            'report_type' => 'required|in:vendeur,produit,transaction,message',
            'reason' => 'required|string|max:500',
        ]);

        $report = Report::create([
            'reporter_id' => $request->reporter_id,
            'reported_id' => $request->reported_id,
            'report_type' => $request->report_type,
            'reason' => $request->reason,
            'status' => 'en attente', // Par défaut, le signalement est en attente
        ]);

        return response()->json(['message' => 'Signalement soumis avec succès', 'report' => $report], 201);
    }

    /**
     * Modifier le statut d’un signalement (Admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en attente,validé,rejeté',
            'admin_notes' => 'nullable|string',
        ]);

        $report = Report::findOrFail($id);
        $report->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return response()->json(['message' => 'Statut du signalement mis à jour', 'report' => $report]);
    }

    /**
     * Supprimer un signalement (Admin).
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json(['message' => 'Signalement supprimé avec succès']);
    }
}
