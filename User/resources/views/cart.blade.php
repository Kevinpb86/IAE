@extends('layouts.layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            @forelse($cartItems ?? [] as $item)
                <div class="flex items-center border-b py-4">
                    <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/100' }}" 
                         alt="{{ $item['name'] ?? 'Product' }}" 
                         class="w-24 h-24 object-contain bg-gray-50">
                    <div class="ml-4 flex-grow">
                        <h3 class="text-lg font-semibold">{{ $item['name'] ?? 'Product Name' }}</h3>
                        <p class="text-gray-600">${{ number_format($item['price'] ?? 0, 2) }}</p>
                        <div class="flex items-center mt-2">
                            <button class="px-2 py-1 border rounded">-</button>
                            <span class="mx-4">{{ $item['quantity'] ?? 1 }}</span>
                            <button class="px-2 py-1 border rounded">+</button>
                        </div>
                    </div>
                    <div class="ml-4">
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-500">Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="mt-4 inline-block bg-primary text-white px-6 py-2 rounded hover:bg-gray-800 transition duration-300">
                        Continue Shopping
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span>${{ number_format($shipping ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax</span>
                        <span>${{ number_format($tax ?? 0, 2) }}</span>
                    </div>
                    <div class="border-t pt-2 mt-2">
                        <div class="flex justify-between font-semibold">
                            <span>Total</span>
                            <span>${{ number_format($total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('checkout') }}" class="w-full block text-center bg-primary text-white py-3 rounded hover:bg-gray-800 transition duration-300">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 