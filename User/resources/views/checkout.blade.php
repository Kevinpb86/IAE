@extends('layouts.layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Checkout</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form id="checkout-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Shipping Information -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div class="md:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone" id="phone" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
                <div class="space-y-4">
                    <div>
                        <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                        <input type="text" name="card_number" id="card_number" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                               placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expiry" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                            <input type="text" name="expiry" id="expiry" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                   placeholder="MM/YY">
                        </div>
                        <div>
                            <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                            <input type="text" name="cvv" id="cvv" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                   placeholder="123">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-6 rounded-lg sticky top-4">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-medium">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    @endforeach
                    
                    <div class="border-t pt-4 space-y-2">
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
                    
                    <button type="button" id="place-order-btn" class="w-full bg-primary text-white py-3 rounded hover:bg-gray-800 transition duration-300">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format card number input
    const cardNumber = document.getElementById('card_number');
    cardNumber.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{4})/g, '$1 ').trim();
        e.target.value = value;
    });

    // Format expiry date input
    const expiry = document.getElementById('expiry');
    expiry.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0,2) + '/' + value.slice(2,4);
        }
        e.target.value = value;
    });

    // Format CVV input
    const cvv = document.getElementById('cvv');
    cvv.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '').slice(0,3);
    });

    // Handle place order button click
    const placeOrderBtn = document.getElementById('place-order-btn');
    placeOrderBtn.addEventListener('click', async function() {
        const form = document.getElementById('checkout-form');
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            placeOrderBtn.disabled = true;
            placeOrderBtn.textContent = 'Processing...';

            const response = await fetch('/api/orders/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data),
                credentials: 'include'
            });

            const result = await response.json();

            if (response.ok) {
                // Redirect to success page or show success message
                window.location.href = `/orders/${result.data.order_number}`;
            } else {
                throw new Error(result.message || 'Failed to process order');
            }
        } catch (error) {
            alert(error.message);
            placeOrderBtn.disabled = false;
            placeOrderBtn.textContent = 'Place Order';
        }
    });
});
</script>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kiri: Alamat & Barang -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Alamat Pengiriman -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-md font-bold mb-2 text-gray-700">ALAMAT PENGIRIMAN</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-green-700"><i class="fas fa-home"></i> Rumah · Nama Pengguna</p>
                        <p class="text-gray-600 text-sm">Jl. Contoh Alamat, Kota, Provinsi, 12345</p>
                        <p class="text-gray-600 text-sm">08123456789</p>
                    </div>
                    <button class="border px-3 py-1 rounded text-gray-600">Ganti</button>
                </div>
            </div>
            <!-- Daftar Barang -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-md font-bold mb-2 text-gray-700">Barang di Keranjang</h2>
                @forelse($cartItems as $item)
                    <div class="flex items-center border-b py-4">
                        <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/100' }}" class="w-20 h-20 object-contain bg-gray-50">
                        <div class="ml-4 flex-grow">
                            <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                            <p class="text-gray-600">Qty: {{ $item['quantity'] }}</p>
                            <p class="text-gray-600">Harga: ${{ number_format($item['price'], 2) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Keranjang kosong.</p>
                @endforelse
            </div>
        </div>
        <!-- Kanan: Pembayaran & Ringkasan -->
        <div class="lg:col-span-1">
            <form action="{{ route('checkout.process') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
                @csrf
                <!-- Metode Pembayaran -->
                <div>
                    <h2 class="text-md font-bold mb-2 text-gray-700">Metode Pembayaran</h2>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="credit_card" class="mr-2" checked>
                            Credit Card
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="debit_card" class="mr-2">
                            Debit Card
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="virtual_account" class="mr-2">
                            Virtual Account
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="e_wallet" class="mr-2">
                            E-Wallet
                        </label>
                        <select name="e_wallet_type" id="e_wallet_type" class="w-full border rounded px-3 py-2 mt-2" style="display:none;">
                            <option value="">Pilih E-Wallet</option>
                            <option value="dana">Dana</option>
                            <option value="gopay">Gopay</option>
                            <option value="shopeepay">ShopeePay</option>
                        </select>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="qris" class="mr-2">
                            QRIS
                        </label>
                    </div>
                </div>
                <div id="qris-image" class="mt-4" style="display:none;">
                    <img src="/images/qr.png" alt="QRIS" class="w-40 mx-auto" />
                </div>
                <!-- Ringkasan Transaksi -->
                <div>
                    <h2 class="text-md font-bold mb-2 text-gray-700">Cek ringkasan transaksimu, yuk</h2>
                    <div class="flex justify-between">
                        <span>Total Harga ({{ count($cartItems) }} Barang)</span>
                        <span>${{ number_format(collect($cartItems)->sum(function($item){return $item['price'] * $item['quantity'];}), 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Ongkos Kirim</span>
                        <span>$10.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total Lainnya</span>
                        <span>$0.00</span>
                    </div>
                    <div class="border-t pt-2 mt-2 flex justify-between font-semibold">
                        <span>Total Tagihan</span>
                        <span>
                            ${{ number_format(collect($cartItems)->sum(function($item){return $item['price'] * $item['quantity'];}) + 10, 2) }}
                        </span>
                    </div>
                </div>
                <button type="submit" id="pay-now-btn" class="w-full bg-black text-white py-3 rounded hover:bg-gray-800 transition duration-300 font-bold">
                    Pay Now
                </button>
            </form>
        </div>
    </div>
</div>
<!-- Script untuk dropdown e-wallet -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="payment_method"]');
        const eWalletSelect = document.getElementById('e_wallet_type');
        const qrisImage = document.getElementById('qris-image');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'e_wallet') {
                    eWalletSelect.style.display = 'block';
                    if(qrisImage) qrisImage.style.display = 'none';
                } else if (this.value === 'qris') {
                    eWalletSelect.style.display = 'none';
                    if(qrisImage) qrisImage.style.display = 'block';
                } else {
                    eWalletSelect.style.display = 'none';
                    if(qrisImage) qrisImage.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection

