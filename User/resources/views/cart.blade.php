@extends('layouts.layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if($cartItems->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">Your cart is empty</p>
            <a href="{{ route('shop') }}" class="inline-block bg-primary text-white px-6 py-2 rounded hover:bg-gray-800 transition duration-300">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white p-4 rounded-lg shadow flex items-center">
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded">
                        <div class="ml-4 flex-grow">
                            <h3 class="font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">${{ number_format($item['price'], 2) }}</p>
                            <div class="flex items-center mt-2">
                                <button class="quantity-btn" data-action="decrease">-</button>
                                <input type="number" value="{{ $item['quantity'] }}" min="1" 
                                       class="quantity-input w-16 text-center mx-2" 
                                       data-cart-id="{{ $item['id'] }}">
                                <button class="quantity-btn" data-action="increase">+</button>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            <button class="remove-item text-red-500 hover:text-red-700 mt-2" 
                                    data-cart-id="{{ $item['id'] }}">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg sticky top-4">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax</span>
                            <span>${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between font-semibold">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('checkout') }}" class="block w-full bg-primary text-white text-center py-3 rounded hover:bg-gray-800 transition duration-300">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
                <a href="{{ route('checkout') }}" class="w-full block text-center bg-primary text-white py-3 rounded hover:bg-gray-800 transition duration-300">
                    Proceed to Checkout
                </a>

            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity changes
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', async function() {
            const cartId = this.dataset.cartId;
            const quantity = this.value;
            
            try {
                const response = await fetch(`/cart/${cartId}/update`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity })
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Failed to update quantity');
                }
            } catch (error) {
                alert(error.message);
            }
        });
    });

    // Handle remove item
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(button => {
        button.addEventListener('click', async function() {
            if (!confirm('Are you sure you want to remove this item?')) return;
            
            const cartId = this.dataset.cartId;
            
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Failed to remove item');
                }
            } catch (error) {
                alert(error.message);
            }
        });
    });

    // Handle quantity buttons
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            const currentValue = parseInt(input.value);
            
            if (this.dataset.action === 'increase') {
                input.value = currentValue + 1;
            } else if (this.dataset.action === 'decrease' && currentValue > 1) {
                input.value = currentValue - 1;
            }
            
            // Trigger change event
            input.dispatchEvent(new Event('change'));
        });
    });
});
</script>
@endpush 
