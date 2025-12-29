<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@bhandara.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create Sample Merchants
        $merchant1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $merchant2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create Sample Tenants (Shops)
        $tenant1 = Tenant::create([
            'slug' => 'nexus-gear',
            'name' => 'Nexus Gear',
            'logo_path' => null,
            'primary_color' => '#667eea',
            'is_active' => true,
            'owner_id' => $merchant1->id,
        ]);

        $tenant2 = Tenant::create([
            'slug' => 'fashion-hub',
            'name' => 'Fashion Hub',
            'logo_path' => null,
            'primary_color' => '#f59e0b',
            'is_active' => true,
            'owner_id' => $merchant2->id,
        ]);

        // Create Categories for Tenant 1
        $electronics = Category::create([
            'tenant_id' => $tenant1->id,
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);

        $accessories = Category::create([
            'tenant_id' => $tenant1->id,
            'name' => 'Accessories',
            'slug' => 'accessories',
        ]);

        // Create Categories for Tenant 2
        $clothing = Category::create([
            'tenant_id' => $tenant2->id,
            'name' => 'Clothing',
            'slug' => 'clothing',
        ]);

        // Create Sample Products for Tenant 1
        Product::create([
            'tenant_id' => $tenant1->id,
            'category_id' => $electronics->id,
            'name' => 'Wireless Mouse',
            'slug' => 'wireless-mouse',
            'sku' => 'WM-001',
            'description' => 'High-precision wireless mouse with ergonomic design',
            'price' => 250000,
            'stock' => 50,
            'images' => null,
            'is_visible' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'tenant_id' => $tenant1->id,
            'category_id' => $electronics->id,
            'name' => 'Mechanical Keyboard',
            'slug' => 'mechanical-keyboard',
            'sku' => 'MK-001',
            'description' => 'RGB mechanical keyboard with blue switches',
            'price' => 750000,
            'stock' => 30,
            'images' => null,
            'is_visible' => true,
            'is_featured' => false,
        ]);

        Product::create([
            'tenant_id' => $tenant1->id,
            'category_id' => $accessories->id,
            'name' => 'USB-C Cable',
            'slug' => 'usbc-cable',
            'sku' => 'UC-001',
            'description' => 'Braided USB-C charging cable 2 meters',
            'price' => 50000,
            'stock' => 100,
            'images' => null,
            'is_visible' => true,
            'is_featured' => false,
        ]);

        // Create Sample Products for Tenant 2
        Product::create([
            'tenant_id' => $tenant2->id,
            'category_id' => $clothing->id,
            'name' => 'Cotton T-Shirt',
            'slug' => 'cotton-tshirt',
            'sku' => 'TS-001',
            'description' => 'Premium cotton t-shirt various colors',
            'price' => 150000,
            'stock' => 80,
            'images' => null,
            'is_visible' => true,
            'is_featured' => true,
        ]);

        Product::create([
            'tenant_id' => $tenant2->id,
            'category_id' => $clothing->id,
            'name' => 'Denim Jeans',
            'slug' => 'denim-jeans',
            'sku' => 'DJ-001',
            'description' => 'Classic fit denim jeans',
            'price' => 350000,
            'stock' => 40,
            'images' => null,
            'is_visible' => true,
            'is_featured' => true,
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('Admin: admin@bhandara.id / password');
        $this->command->info('Merchant 1: john@example.com / password (nexus-gear)');
        $this->command->info('Merchant 2: jane@example.com / password (fashion-hub)');
    }
}
