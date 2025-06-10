@extends('layouts.layouts')

@section('content')
<!-- Hero Section with Parallax -->
<div class="relative bg-gray-900 py-32 overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover transform scale-105" src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Fashion background">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-600 opacity-75"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl animate-fade-in">
                Pre-Order Your Style
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Be the first to get your hands on our latest collection. Fill out the form below to secure your pre-order.
            </p>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Limited Time Offer
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="bg-gradient-to-b from-gray-50 to-white py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-8 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
            <!-- Form Header -->
            <div class="px-8 py-10 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Pre-Order Form</h2>
                        <p class="mt-2 text-sm text-gray-600">Please fill in all the required information below.</p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="text-sm text-gray-600">Secure Form</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-10">
                <form action="{{ route('preorder.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Name Input -->
                    <div class="space-y-2 mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 flex items-center">
                            Name <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="Enter your name">
                    </div>

                    <!-- Price Input
                    <div class="space-y-2">
                        <label for="price" class="block text-sm font-medium text-gray-700 flex items-center">
                            Price <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="number" name="price" id="price" min="0" step="0.01" class="focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">USD</span>
                            </div>
                        </div>
                    </div> -->

                    <!-- Product Selection -->
                    <div class="space-y-2">
                        <label for="product" class="block text-sm font-medium text-gray-700 flex items-center">
                            Select Product <span class="text-red-500 ml-1">*</span>
                        </label>
                        <select id="product" name="product" class="mt-1 block w-full pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg transition-colors duration-200">
                            <option value="">Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->name }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Display Price -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Price per piece:</label>
                        <p id="selected-product-price" class="text-lg font-bold text-gray-900">Select a product to see the price</p>
                    </div>

                    <!-- Quantity -->
                    <div class="space-y-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 flex items-center">
                            Quantity <span class="text-red-500 ml-1">*</span>
                            <span class="ml-2 text-xs text-gray-500">(Minimum 1 piece)</span>
                        </label>
                        <div class="mt-1 relative rounded-lg shadow-sm">
                            <input type="number" name="quantity" id="quantity" min="1" class="focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 py-3 sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="1">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">pcs</span>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 flex items-center">
                            Delivery Address <span class="text-red-500 ml-1">*</span>
                        </label>
                        <textarea id="address" name="address" rows="3" class="mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="Enter your complete delivery address"></textarea>
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 flex items-center">
                                Phone Number <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">+62</span>
                                </div>
                                <input type="tel" name="phone_number" id="phone_number" class="focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 pr-3 py-3 sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="812-3456-7890">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 flex items-center">
                                Email <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="email" name="email" id="email" class="mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="you@example.com">
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div class="space-y-2">
                        <label for="additional_notes" class="block text-sm font-medium text-gray-700 flex items-center">
                            Additional Notes
                            <span class="ml-2 text-xs text-gray-500">(Optional)</span>
                        </label>
                        <textarea id="additional_notes" name="additional_notes" rows="3" class="mt-1 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg transition-colors duration-200" placeholder="Any special instructions or requests?"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-8">
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-lg shadow-lg text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Submit Pre-Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 bg-white shadow-2xl rounded-2xl overflow-hidden">
            <div class="px-8 py-10">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Important Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">Pre-orders are processed on a first-come, first-served basis.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">You will receive a confirmation email once your pre-order is confirmed.</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">Estimated delivery time will be provided after confirmation.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">For any questions, please contact our customer service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add custom styles for animations -->
<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-in;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.querySelector('form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Get selected product name and price from data attributes
        const productSelect = document.getElementById('product');
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const itemName = selectedOption.getAttribute('data-name');
        const itemPrice = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(data.quantity, 10);

        // Calculate total price
        const totalPrice = itemPrice * quantity;

        // Create data object with new keys
        const apiData = {
            customer_name: data.name,
            customer_email: data.email,
            item_name: itemName,
            item_quantity: quantity,
            total_price: totalPrice,
            address: data.address,
            phone_number: data.phone_number,
            additional_notes: data.additional_notes || null
        };

        try {
            const response = await fetch('http://127.0.0.1:8001/api/preorders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(apiData),
            });

            if (response.ok) {
                const result = await response.json();
                alert('Pre-order submitted successfully!');
                window.location.reload(); // Reload the page after successful submission
            } else {
                const error = await response.json();
                alert('Error: ' + JSON.stringify(error));
            }
        } catch (err) {
            console.error('Error:', err);
            alert('Failed to submit pre-order. Please try again.');
        }
    });

    // Javascript to update price based on product selection
    const productSelect = document.getElementById('product');
    const priceDisplay = document.getElementById('selected-product-price');

    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');

        if (price) {
            priceDisplay.textContent = `Price: $${parseFloat(price).toFixed(2)}`;
        } else {
            priceDisplay.textContent = 'Select a product to see the price';
        }
    });
</script>
@endsection