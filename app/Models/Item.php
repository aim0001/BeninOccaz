<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'taille',
        'price',
        'category',
        'condition',
        'images',
        'delivery_method',
        'meetup_location',
        'approval_status',
        'admin_notes',
        'approved_at',
        'approved_by',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'is_sold' => 'boolean',
        'approved_at' => 'datetime',
    ];

    /**
     * Conditions possibles pour un article
     */
    public const CONDITIONS = [
        'new_with_tags' => 'Neuf avec étiquette',
        'new_without_tags' => 'Neuf sans étiquette',
        'excellent' => 'Très bon état',
        'good' => 'Bon état',
        'fair' => 'État correct',
        'poor' => 'État usé',
    ];

    /**
     * Méthodes de livraison possibles
     */
    public const DELIVERY_METHODS = [
        'meetup' => 'Remise en main propre',
        'carrier' => 'Livraison par transporteur',
    ];

    /**
     * Relation avec l'utilisateur (vendeur)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation : Un article peut avoir plusieurs commandes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Filtre les articles disponibles
    public static function available()
    {
        return self::where('is_sold', false);
    }

    /**
     * Accesseur pour les URLs complètes des images
     */
    public function getImageUrlsAttribute(): array
    {
        if (empty($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            return Storage::url($image);
        }, $this->images);
    }

    /**
     * Accesseur pour la condition lisible
     */
    public function getReadableConditionAttribute(): string
    {
        return self::CONDITIONS[$this->condition] ?? $this->condition;
    }

    /**
     * Accesseur pour la méthode de livraison lisible
     */
    public function getReadableDeliveryMethodAttribute(): string
    {
        return self::DELIVERY_METHODS[$this->delivery_method] ?? $this->delivery_method;
    }

    /**
     * Vérifie si l'article est disponible à la vente
     */
    public function isAvailable(): bool
    {
        return !$this->is_sold;
    }

    /**
     * Marque l'article comme vendu
     */
    public function markAsSold(): void
    {
        $this->update(['is_sold' => true]);
    }

    /**
     * Marque l'article comme disponible
     */
    public function markAsAvailable(): void
    {
        $this->update(['is_sold' => false]);
    }

    /**
     * Scope pour les articles disponibles
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_sold', false);
    }   

    /**
     * Scope pour les articles d'une catégorie spécifique
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope pour les articles par méthode de livraison
     */
    public function scopeWithDeliveryMethod($query, $method)
    {
        return $query->where('delivery_method', $method);
    }
    public function featured()
    {
        return $this->hasOne(FeaturedItem::class);
    }

    /**
     * Relation avec l'admin qui a approuvé l'article
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope pour les articles approuvés
     */
    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    /**
     * Scope pour les articles en attente d'approbation
     */
    public function scopePending($query)
    {
        return $query->where('approval_status', 'pending');
    }

    /**
     * Scope pour les articles rejetés
     */
    public function scopeRejected($query)
    {
        return $query->where('approval_status', 'rejected');
    }

    /**
     * Vérifie si l'article est approuvé
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Vérifie si l'article est en attente
     */
    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Vérifie si l'article est rejeté
     */
    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Approuve l'article
     */
    public function approve($adminId, $notes = null): void
    {
        $this->update([
            'approval_status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    /**
     * Rejette l'article
     */
    public function reject($adminId, $notes = null): void
    {
        $this->update([
            'approval_status' => 'rejected',
            'approved_by' => $adminId,
            'admin_notes' => $notes,
        ]);
    }

}