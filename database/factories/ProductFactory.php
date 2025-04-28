<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $apiProducts ='https://api.unsplash.com/photos/random?query=products&client_id=0ki1tD5vchlNaiH0st86LSfzBhZeOaX5ZzbrDKGKT4U';
        $defaultImage= 'https://ui-avatars.com/api/?name=Course&background=random&color=fff';
        $imageUrl= '';
        try{
            $response = Http::withoutVerifying()->get($apiProducts);
            if($response->successful()){
                $result =$response->json();
                $imageUrl= $result['urls']['regular'] ?? $defaultImage;
            }
        }catch(\Exception $e){
            $imageUrl= $defaultImage;
        }
        


        return [
            'supplier_id' => Supplier::factory(),
            'categorie_id' => Category::factory(),
            'name' => fake()->word(),
            'image' =>$imageUrl,
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000)
        ];
    }
}