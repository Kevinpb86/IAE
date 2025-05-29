@extends('layouts.layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Our Shop</h1>
    
    <!-- Filters -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <select class="border rounded px-4 py-2">
                    <option>Sort by: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest First</option>
                </select>
                <select class="border rounded px-4 py-2">
                    <option>Category: All</option>
                    <option>Clothing</option>
                    <option>Accessories</option>
                    <option>Shoes</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <span>View:</span>
                <button class="p-2 border rounded"><i class="fas fa-th"></i></button>
                <button class="p-2 border rounded"><i class="fas fa-list"></i></button>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $product['image_url'] ?? 'https://via.placeholder.com/300x400' }}" 
                     alt="{{ $product['name'] ?? 'Product' }}" 
                     class="w-full h-64 object-contain bg-gray-50">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product['name'] ?? 'Product Name' }}</h3>
                    <p class="text-gray-600 mb-2">${{ number_format($product['price'] ?? 0, 2) }}</p>
                    <button class="w-full bg-primary text-white py-2 rounded hover:bg-gray-800 transition duration-300">
                        Add to Cart
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No products available at the moment.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <nav class="flex items-center space-x-2">
            <a href="#" class="px-3 py-2 border rounded hover:bg-gray-100">Previous</a>
            <a href="#" class="px-3 py-2 border rounded bg-primary text-white">1</a>
            <a href="#" class="px-3 py-2 border rounded hover:bg-gray-100">2</a>
            <a href="#" class="px-3 py-2 border rounded hover:bg-gray-100">3</a>
            <a href="#" class="px-3 py-2 border rounded hover:bg-gray-100">Next</a>
        </nav>
    </div>
</div>
@endsection 