<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Models\User;

class CreateTestItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test item for approval workflow demonstration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find a user to assign the item to
        $user = User::where('role', '!=', 'admin')->first();

        if (!$user) {
            // Create a test user
            $user = User::create([
                'name' => 'Test Vendeur',
                'email' => 'vendeur@test.com',
                'password' => bcrypt('password'),
                'role' => 'seller',
                'phone' => '+22912345678',
                'city' => 'Cotonou',
            ]);
        }

        // Create a test item
        $item = Item::create([
            'user_id' => $user->id,
            'title' => 'iPhone 13 Pro Max - Comme neuf',
            'description' => 'iPhone 13 Pro Max en excellent état, utilisé pendant 6 mois seulement. Aucune rayure, batterie en parfait état. Vendu avec chargeur et boîte d\'origine.',
            'taille' => '128GB',
            'price' => 450000,
            'category' => 'Électronique',
            'condition' => 'excellent',
            'delivery_method' => 'meetup',
            'meetup_location' => 'Carrefour Dantokpa, Cotonou',
            'approval_status' => 'pending',
        ]);

        $this->info('✅ Test item created successfully!');
        $this->info("Item ID: {$item->id}");
        $this->info("Title: {$item->title}");
        $this->info("Seller: {$user->name}");
        $this->info("Status: {$item->approval_status}");
        $this->info("\nYou can now see this item in the admin pending items section.");
    }
}
