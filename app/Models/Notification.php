<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message', 'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relation : Une notification appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
