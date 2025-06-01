<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'message'
    ];

    // Relation : Un message est envoyé par un utilisateur
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relation : Un message est reçu par un utilisateur
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

