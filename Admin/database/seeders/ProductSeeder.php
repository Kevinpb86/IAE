<?php

namespace Database\Seeders;

use App\Models\Product;
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
                'product_name' => 'Classic White T-Shirt',
                'category' => 'T-Shirts',
                'gender' => 'male',
                'size' => 'S,M,L,XL',
                'price' => 29.99,
                'stock' => 100,
                'image' => 'Product/celana.png'
            ],
            [
                'product_name' => 'Summer Dress',
                'category' => 'Dresses',
                'gender' => 'female',
                'size' => 'XS,S,M,L',
                'price' => 49.99,
                'stock' => 50,
                'image' => 'Product/dress1.jpg'
            ],
            [
                'product_name' => 'Denim Jeans',
                'category' => 'Pants',
                'gender' => 'male',
                'size' => '30,32,34,36',
                'price' => 59.99,
                'stock' => 75,
                'image' => 'Product/jeans1.jpg'
            ],
            [
                'product_name' => 'Floral Blouse',
                'category' => 'Tops',
                'gender' => 'female',
                'size' => 'S,M,L',
                'price' => 39.99,
                'stock' => 60,
                'image' => 'Product/blouse1.jpg'
            ],
            [
                'product_name' => 'Casual Hoodie',
                'category' => 'Hoodies',
                'gender' => 'male',
                'size' => 'M,L,XL,XXL',
                'price' => 45.99,
                'stock' => 40,
                'image' => 'Product/hoodie1.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 