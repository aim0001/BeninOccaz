<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_id', 'rating', 'comment'
    ];

    // Relation : Une évaluation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une évaluation concerne un article spécifique
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
