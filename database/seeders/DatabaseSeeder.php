<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::factory(1)->create();

        // Create categories
        $categories = Category::factory(5)->create();

        // Create suppliers
        $suppliers = Supplier::factory(10)->create();

        // Create customers
        $customers = Customer::factory(10)->create();

        // Create products and associate them with categories & suppliers
        $products = Product::factory(20)
            ->recycle($categories)
            ->recycle($suppliers)
            ->create();

        // Create stores with stocks
        $stores = Store::factory(5)->create();
        
        // Create stocks and associate them with products and stores
        foreach ($stores as $store) {
            $stocksForStore = Stock::factory()->create([
                'name_entropot' => $store->name,
                'addresse_entropot' => $store->address
            ]);
            
            // Update store with stock
    
            
            // Associate random products with the stock
            $selectedProducts = $products->random(rand(3, 5));
            foreach ($selectedProducts as $product) {
                Stock::factory()->create([
                    'product_id' => $product->id,
                    'store_id' => $store->id,
                    'quantity' => rand(10, 100),
                    'name_entropot' => $store->name,
                    'addresse_entropot' => $store->address
                ]);
            }
        }

        // Create orders with proper customer and product relationships
        Order::factory(15)
            ->recycle($customers)
            ->create()
            ->each(function ($order) use ($products) {
                $order->products()->attach(
                    $products->random(rand(1, 3))->pluck('id')->toArray(),
                    [
                        'quantite_commande' => rand(1, 10),
                        'prix_vente' => rand(100, 1000)
                    ]
                );
            });
    }
}
