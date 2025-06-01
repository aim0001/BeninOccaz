<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',  // ID de l'utilisateur qui fait le signalement
        'reported_id',  // ID de l'utilisateur ou produit signalé
        'report_type',  // Type de signalement ('vendeur', 'produit', 'transaction', 'message')
        'reason',       // Motif du signalement (arnaque, produit non conforme, fraude)
        'status',       // État du signalement ('en attente', 'validé', 'rejeté')
        'admin_notes',  // Notes ajoutées par l'admin pour gérer le litige
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reported()
    {
        return $this->belongsTo(User::class, 'reported_id');
    }
}

