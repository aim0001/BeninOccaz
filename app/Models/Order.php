<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_id', 'total_price', 'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relation : Une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Une commande concerne un article spécifique
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
