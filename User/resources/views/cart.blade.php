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
            @if($cartItems->count() > 0)
                @foreach($cartItems as $item)
                    <div class="flex items-center border-b py-4">
                        <img src="{{ $item['image_url'] }}" 
                             alt="{{ $item['name'] }}" 
                             class="w-24 h-24 object-contain bg-gray-50">
                        <div class="ml-4 flex-grow">
                            <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">${{ number_format($item['price'], 2) }}</p>
                            <div class="flex items-center mt-2">
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="px-2 py-1 border rounded decrease-quantity">-</button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="mx-4 w-16 text-center quantity-input">
                                    <button type="button" class="px-2 py-1 border rounded increase-quantity">+</button>
                                </form>
                            </div>
                        </div>
                        <div class="ml-4">
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="mt-4 inline-block bg-primary text-white px-6 py-2 rounded hover:bg-gray-800 transition duration-300">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-2 mb-4">
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
                </div>
                <button class="w-full bg-primary text-white py-3 rounded hover:bg-gray-800 transition duration-300">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity updates
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const decreaseButtons = document.querySelectorAll('.decrease-quantity');
    const increaseButtons = document.querySelectorAll('.increase-quantity');

    quantityInputs.forEach((input, index) => {
        decreaseButtons[index].addEventListener('click', () => {
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                input.form.submit();
            }
        });

        increaseButtons[index].addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
            input.form.submit();
        });

        input.addEventListener('change', () => {
            if (input.value < 1) input.value = 1;
            input.form.submit();
        });
    });
});
</script>
@endpush 
