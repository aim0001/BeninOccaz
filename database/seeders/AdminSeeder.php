<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin user if exists
        User::where('email', 'admin@beninocccaz.com')->delete();

        try {
            $admin = User::create([
                'name' => 'Admin BeninOccaz',
                'email' => 'admin@beninocccaz.com',
                'password' => Hash::make('Admin123!'),
                'user_type' => 'admin',
                'email_verified_at' => now(),
                'address' => 'Cotonou, Bénin',
                'city' => 'Cotonou',
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@beninocccaz.com');
            $this->command->info('Password: Admin123!');
            $this->command->info('User ID: ' . $admin->id);
            $this->command->info('User Type: ' . $admin->user_type);

        } catch (\Exception $e) {
            $this->command->error('Error creating admin user: ' . $e->getMessage());
            $this->command->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
