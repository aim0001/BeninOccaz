<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update all users to have role = 'buyer' if role is null
        DB::table('users')->whereNull('role')->update(['role' => 'buyer']);

        // Create admin user directly with SQL
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@beninocccaz.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@beninocccaz.com',
                'password' => bcrypt('SuperAdmin2024!'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Update existing user to admin
        DB::table('users')
            ->where('email', 'inoussahilal29@gmail.com')
            ->update([
                'role' => 'admin',
                'password' => bcrypt('SuperAdmin2024!'),
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset admin users back to buyer
        DB::table('users')->where('role', 'admin')->update(['role' => 'buyer']);
    }
};
