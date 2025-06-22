<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class VerifyAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify admin setup and test login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Verifying admin setup...');

        // Check all users
        $users = User::all();
        $this->info("\n📋 All users in database:");
        foreach($users as $user) {
            $this->info("- {$user->name} ({$user->email}) - Role: " . ($user->role ?? 'null'));
        }

        // Check admin user
        $admin = User::where('email', 'admin@beninocccaz.com')->first();
        if($admin) {
            $this->info("\n✅ Admin user found!");
            $this->info("Name: {$admin->name}");
            $this->info("Email: {$admin->email}");
            $this->info("Role: {$admin->role}");

            // Test password
            if(Hash::check('SuperAdmin2024!', $admin->password)) {
                $this->info("✅ Password verification: SUCCESS");
            } else {
                $this->error("❌ Password verification: FAILED");
            }

            // Test authentication
            if(Auth::attempt(['email' => 'admin@beninocccaz.com', 'password' => 'SuperAdmin2024!'])) {
                $this->info("✅ Authentication test: SUCCESS");
                $this->info("✅ Admin can login successfully!");

                // Test admin gate
                if(Auth::user()->role === 'admin') {
                    $this->info("✅ Admin role check: SUCCESS");
                } else {
                    $this->error("❌ Admin role check: FAILED");
                }

                Auth::logout();
            } else {
                $this->error("❌ Authentication test: FAILED");
            }

        } else {
            $this->error("\n❌ Admin user not found!");
        }

        $this->info("\n🎯 To access admin dashboard:");
        $this->info("1. Go to: http://127.0.0.1:8000/test-admin");
        $this->info("2. Or login at: http://127.0.0.1:8000/login");
        $this->info("   Email: admin@beninocccaz.com");
        $this->info("   Password: SuperAdmin2024!");
    }
}
