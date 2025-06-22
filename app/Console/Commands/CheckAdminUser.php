<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check admin user and verify credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'admin@beninocccaz.com';
        $password = 'Admin123!';

        // First, let's make the existing user an admin as a workaround
        $existingUser = User::where('email', 'inoussahilal29@gmail.com')->first();
        if ($existingUser) {
            $existingUser->user_type = 'admin';
            $existingUser->password = Hash::make('Admin123!'); // Reset password
            $existingUser->save();
            $this->info("✅ Made existing user '{$existingUser->name}' an admin");
            $this->info("✅ Password reset to: Admin123!");
            $this->info("You can now login with:");
            $this->info("Email: inoussahilal29@gmail.com");
            $this->info("Password: Admin123!");

            // Test authentication
            if (Hash::check('Admin123!', $existingUser->password)) {
                $this->info("✅ Password hash verification: SUCCESS");
            } else {
                $this->error("❌ Password hash verification: FAILED");
            }
        }

        // Now try to create the dedicated admin user
        $this->info("\nAttempting to create dedicated admin user...");

        // Delete existing admin if exists
        User::where('email', $email)->delete();

        try {
            $admin = new User();
            $admin->name = 'Admin BeninOccaz';
            $admin->email = $email;
            $admin->password = Hash::make($password);
            $admin->user_type = 'admin';
            $admin->email_verified_at = now();
            $admin->address = 'Cotonou, Bénin';
            $admin->city = 'Cotonou';
            $admin->save();

            $this->info("✅ Admin user created with ID: " . $admin->id);
        } catch (\Exception $e) {
            $this->error("❌ Failed to create admin: " . $e->getMessage());
            $this->error("Error details: " . $e->getFile() . ':' . $e->getLine());
        }

        // Now check if user exists
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->info("\n✅ Admin user found:");
            $this->info("ID: " . $user->id);
            $this->info("Name: " . $user->name);
            $this->info("Email: " . $user->email);
            $this->info("User Type: " . $user->user_type);
            $this->info("Email Verified: " . ($user->email_verified_at ? 'Yes' : 'No'));

            // Check password
            if (Hash::check($password, $user->password)) {
                $this->info("✅ Password verification: SUCCESS");
            } else {
                $this->error("❌ Password verification: FAILED");
            }
        } else {
            $this->error("❌ Admin user not found!");
        }

        // Also show all users for debugging
        $this->info("\nAll users in database:");
        $users = User::all();
        foreach ($users as $u) {
            $this->info("- {$u->name} ({$u->email}) - Type: {$u->user_type}");
        }
    }
}
