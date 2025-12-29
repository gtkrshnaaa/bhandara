<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin / Merchant
        $merchant = User::create([
            'name' => 'Aditya Mahendra',
            'email' => 'aditya@bhandara.id',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Tenant (The Shop)
        $tenant = Tenant::create([
            'owner_id' => $merchant->id,
            'slug' => 'nexus-gear',
            'name' => 'Nexus Gear Official',
            'primary_color' => '#6366f1', // Indigo
            'is_active' => true,
        ]);

        // 3. Create Categories
        $electronics = Category::create([
            'tenant_id' => $tenant->id,
            'name' => 'Electronics',
            'slug' => 'electronics',
            'is_active' => true,
        ]);

        $wearables = Category::create([
            'tenant_id' => $tenant->id,
            'parent_id' => $electronics->id,
            'name' => 'Wearables',
            'slug' => 'wearables',
            'is_active' => true,
        ]);

        // 4. Create Products
        $watch = Product::create([
            'tenant_id' => $tenant->id,
            'category_id' => $wearables->id,
            'name' => 'Nexus Watch Ultra',
            'slug' => 'nexus-watch-ultra',
            'sku' => 'NEX-W-001',
            'description' => 'The ultimate smartwatch for explorers.',
            'price' => 5990000,
            'stock' => 50,
            'is_visible' => true,
            'is_featured' => true,
        ]);

        $earbuds = Product::create([
            'tenant_id' => $tenant->id,
            'category_id' => $electronics->id,
            'name' => 'Nexus Buds Pro',
            'slug' => 'nexus-buds-pro',
            'sku' => 'NEX-B-002',
            'description' => 'Active Noise Cancellation with 24h battery life.',
            'price' => 2490000,
            'stock' => 100,
            'is_visible' => true,
        ]);

        // 5. Create Customer
        $customer = Customer::create([
            'tenant_id' => $tenant->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'phone' => '081234567890',
            'address' => 'Jl. Sudirman No. 1, Jakarta Pusat',
        ]);

        // 6. Create Order
        $order = Order::create([
            'tenant_id' => $tenant->id,
            'customer_id' => $customer->id,
            'number' => 'ORD-2023-1001',
            'total_price' => 5990000,
            'status' => 'processing',
            'payment_status' => 'paid',
            'shipping_address' => 'Jl. Sudirman No. 1, Jakarta Pusat',
        ]);

        // 7. Create Order Items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $watch->id,
            'product_name' => $watch->name,
            'price' => $watch->price,
            'quantity' => 1,
            'total' => $watch->price * 1,
        ]);

        // 8. Create Transaction
        Transaction::create([
            'tenant_id' => $tenant->id,
            'order_id' => $order->id,
            'amount' => 5990000,
            'payment_method' => 'manual_transfer',
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $merchant->id,
        ]);

        $this->command->info('Bhandara Seeder Run Successfully!');
        $this->command->info('User: aditya@bhandara.id / password');
        $this->command->info('Tenant: Nexus Gear Official (nexus-gear)');
    }
}
