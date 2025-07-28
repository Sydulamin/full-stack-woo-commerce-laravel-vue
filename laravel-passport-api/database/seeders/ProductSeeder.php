<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 19.99,
                'stock' => 100,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 29.99,
                'stock' => 50,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'price' => 39.99,
                'stock' => 75,
            ],
            [   'name' => 'Product 4',
                'description' => 'Description for Product 4',
                'price' => 49.99,
                'stock' => 20,
            ],
            [   'name' => 'Product 5',
                'description' => 'Description for Product 5',
                'price' => 59.99,
                'stock' => 10,
            ],

            [   'name' => 'Product 6',
                'description' => 'Description for Product 6',
                'price' => 69.99,
                'stock' => 5,
            ],
        ];
        // Here you can seed the products table with initial data.
        // For example, you can create some products using the Product model.
        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        // You can add more products as needed.
    }
}
