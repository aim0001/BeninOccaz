<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user directly here
        User::updateOrCreate(
            ['email' => 'admin@beninocccaz.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@beninocccaz.com',
                'password' => Hash::make('SuperAdmin2024!'),
                'role' => 'admin',
                'user_type' => 'admin',
                'email_verified_at' => now(),
                'address' => 'Cotonou, Bénin',
                'city' => 'Cotonou',
            ]
        );

        // Also update existing user to be admin
        User::where('email', 'inoussahilal29@gmail.com')->update([
            'role' => 'admin',
            'user_type' => 'admin',
            'password' => Hash::make('SuperAdmin2024!')
        ]);

        $this->command->info('Admin users created/updated successfully!');

        // Create some test items for demonstration
        $this->createTestItems();
    }

    private function createTestItems()
    {
        // Find or create a test seller
        $seller = User::updateOrCreate(
            ['email' => 'vendeur@test.com'],
            [
                'name' => 'Test Vendeur',
                'email' => 'vendeur@test.com',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'phone' => '+22912345678',
                'city' => 'Cotonou',
                'email_verified_at' => now(),
            ]
        );

        // Create approved test items
        $testItems = [
            [
                'title' => 'iPhone 13 Pro Max - Comme neuf',
                'description' => 'iPhone 13 Pro Max en excellent état, utilisé pendant 6 mois seulement. Aucune rayure, batterie en parfait état. Vendu avec chargeur et boîte d\'origine.',
                'taille' => '128GB',
                'price' => 450000,
                'category' => 'electronique',
                'condition' => 'excellent',
                'images' => 'product-01.jpg',
                'delivery_method' => 'meetup',
                'meetup_location' => 'Carrefour Dantokpa, Cotonou',
                'approval_status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'title' => 'Robe élégante - Taille M',
                'description' => 'Belle robe élégante parfaite pour les occasions spéciales. Portée une seule fois, en parfait état.',
                'taille' => 'M',
                'price' => 25000,
                'category' => 'femme',
                'condition' => 'excellent',
                'images' => 'product-02.jpg',
                'delivery_method' => 'meetup',
                'meetup_location' => 'Centre-ville Cotonou',
                'approval_status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'title' => 'Chaussures Nike Air Max',
                'description' => 'Chaussures Nike Air Max en très bon état. Pointure 42, portées quelques fois seulement.',
                'taille' => '42',
                'price' => 35000,
                'category' => 'chaussures',
                'condition' => 'good',
                'images' => 'product-03.jpg',
                'delivery_method' => 'carrier',
                'approval_status' => 'approved',
                'approved_at' => now(),
            ],
            [
                'title' => 'Sac à main Louis Vuitton',
                'description' => 'Sac à main Louis Vuitton authentique, en cuir véritable. Très peu utilisé, comme neuf.',
                'taille' => 'Unique',
                'price' => 180000,
                'category' => 'accessoires',
                'condition' => 'excellent',
                'images' => 'product-04.jpg',
                'delivery_method' => 'meetup',
                'meetup_location' => 'Fidjrossè, Cotonou',
                'approval_status' => 'approved',
                'approved_at' => now(),
            ]
        ];

        foreach ($testItems as $itemData) {
            \App\Models\Item::updateOrCreate(
                ['title' => $itemData['title']],
                array_merge($itemData, ['user_id' => $seller->id])
            );
        }

        $this->command->info('Test items created successfully!');
    }
}
