<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('notifiable'); // Corrige l'erreur en gérant les notifications polymorphiques
            $table->string('type'); // Type de notification (ex: message, commande, paiement)
            $table->text('data'); // Contenu JSON des notifications
            $table->boolean('is_read')->default(false); // Statut de lecture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
