<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user with working credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating admin user...');

        try {
            // First, let's see what's in the database
            $this->info('Current users in database:');
            $users = User::all();
            foreach($users as $user) {
                $this->info("- {$user->name} ({$user->email}) - Type: " . ($user->user_type ?? 'null'));
            }

            // Update existing user to admin
            $existingUser = User::where('email', 'inoussahilal29@gmail.com')->first();
            if ($existingUser) {
                $existingUser->role = 'admin';
                $existingUser->user_type = 'admin';
                $existingUser->password = Hash::make('SuperAdmin2024!');
                $existingUser->save();

                $this->info('✅ Updated existing user to admin');
                $this->info("Email: {$existingUser->email}");
                $this->info("Password: SuperAdmin2024!");
                $this->info("Role: {$existingUser->role}");
                $this->info("User Type: {$existingUser->user_type}");

                // Verify password
                if (Hash::check('SuperAdmin2024!', $existingUser->password)) {
                    $this->info('✅ Password verification: SUCCESS');
                } else {
                    $this->error('❌ Password verification: FAILED');
                }
            }

            // Also try to create a new admin user
            User::updateOrCreate(
                ['email' => 'admin@beninocccaz.com'],
                [
                    'name' => 'Super Admin',
                    'email' => 'admin@beninocccaz.com',
                    'password' => Hash::make('SuperAdmin2024!'),
                    'role' => 'admin',
                    'user_type' => 'admin',
                    'email_verified_at' => now(),
                ]
            );

            $this->info('✅ Admin user created/updated');
            $this->info("Email: admin@beninocccaz.com");
            $this->info("Password: SuperAdmin2024!");

            // Show final user list
            $this->info('\nFinal user list:');
            $users = User::all();
            foreach($users as $user) {
                $this->info("- {$user->name} ({$user->email}) - Role: " . ($user->role ?? 'null') . " - Type: " . ($user->user_type ?? 'null'));
            }

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->error('File: ' . $e->getFile() . ':' . $e->getLine());
        }
    }
}
