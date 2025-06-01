<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // ID unique du signalement
            $table->foreignId('reporter_id')->constrained('users')->onDelete('cascade'); // Utilisateur qui fait le signalement
            $table->foreignId('reported_id')->constrained('users')->onDelete('cascade'); // Utilisateur signalé
            $table->enum('report_type', ['vendeur', 'produit', 'transaction', 'message'])->default('vendeur'); // Type de signalement
            $table->text('reason'); // Motif du signalement (arnaque, produit non conforme, etc.)
            $table->enum('status', ['en attente', 'validé', 'rejeté'])->default('en attente'); // Statut du signalement
            $table->text('admin_notes')->nullable(); // Notes de l'admin pour la gestion du litige
            $table->timestamps(); // Ajout des colonnes `created_at` et `updated_at`
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};

