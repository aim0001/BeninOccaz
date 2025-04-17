<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->string('condition'); // "Neuf avec étiquette", "Très bon état", "État correct"
            $table->json('images')->nullable()->comment('Tableau des chemins des images (max 5)');
            $table->boolean('is_sold')->default(false); // true (vendu), false (disponible)
            $table->string('delivery_method')->default('meetup'); // meetup (Remise en main propre) ou carrier (Livraison par un transporteur)
            $table->string('meetup_location')->nullable(); //"Place du Souvenir, Cotonou"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
