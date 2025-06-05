@extends('layouts.layouts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Checkout</h1>
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
