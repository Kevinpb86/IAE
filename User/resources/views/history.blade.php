@extends('layouts.layouts')

@section('content')
<div class="min-h-screen bg-[#f3efec]">
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-black to-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Order History</h1>
            <p class="text-gray-300">Track and manage all your orders in one place</p>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $order->order_id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $products = json_decode($order->products, true);
                                    $totalPrice = 0;
                                @endphp
                                @if(is_array($products) && !empty($products))
                                    @foreach($products as $product)
                                        <div class="text-sm text-gray-900">{{ $product['quantity'] ?? '1' }}x {{ $product['name'] ?? 'N/A' }}</div>
                                        @php
                                            $totalPrice += ($product['price'] ?? 0) * ($product['quantity'] ?? 1);
                                        @endphp
                                    @endforeach
                                @else
                                    <div class="text-sm text-gray-500">Tidak ada produk</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ number_format($totalPrice, 2) }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                Tidak ada riwayat pesanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 