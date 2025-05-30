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
                'product_name' => 'Strave Blanc Short',
                'category' => 'Men',
                'gender' => 'male',
                'size' => 'S,M,L,XL',
                'price' => 29.99,
                'stock' => 100,
                'image' => 'Product/celana.png'
            ],
            [
                'product_name' => 'Summer Dress',
                'category' => 'Women',
                'gender' => 'female',
                'size' => 'XS,S,M,L',
                'price' => 49.99,
                'stock' => 50,
                'image' => 'Product/womenshirt.png'
            ],
            [
                'product_name' => 'Ocean Tailored Pants',
                'category' => 'Men',
                'gender' => 'male',
                'size' => 'S,M,L,XL',
                'price' => 59.99,
                'stock' => 75,
                'image' => 'Product/Denim.png'
            ],
            [
                'product_name' => 'Floral Blouse',
                'category' => 'Women',
                'gender' => 'female',
                'size' => 'S,M,L',
                'price' => 39.99,
                'stock' => 60,
                'image' => 'Product/womenyellow.png'
            ],
            [
                'product_name' => 'Noir Essential Shirt',
                'category' => 'Men',
                'gender' => 'male',
                'size' => 'M,L,XL,XXL',
                'price' => 45.99,
                'stock' => 40,
                'image' => 'Product/blackTshirt.png'
            ],
            [
                'product_name' => 'Earthone Classic Tee',
                'category' => 'Men',
                'gender' => 'male',
                'size' => 'S,M,L,XL',
                'price' => 69.99,
                'stock' => 30,
                'image' => 'Product/TshirtBrown.png'
            ],
            [
                'product_name' => 'Wide Pull-On Trousers',
                'category' => 'Women',
                'gender' => 'female',
                'size' => 'XS,S,M,L',
                'price' => 54.99,
                'stock' => 45,
                'image' => 'Product/wide.png'
            ],
            [
                'product_name' => 'Regular Fit Cotton Resort Shirt',
                'category' => 'Men',
                'gender' => 'male',
                'size' => 'S,M,L,XL,XXL',
                'price' => 79.99,
                'stock' => 25,
                'image' => 'Product/cotton.png'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 