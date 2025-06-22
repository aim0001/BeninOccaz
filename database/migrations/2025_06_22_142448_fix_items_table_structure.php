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
        Schema::table('items', function (Blueprint $table) {
            // Rename 'etat' to 'condition' to match the model
            $table->renameColumn('etat', 'condition');

            // Add missing delivery_method field
            $table->string('delivery_method')->default('meetup')->after('condition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('condition', 'etat');
            $table->dropColumn('delivery_method');
        });
    }
};
