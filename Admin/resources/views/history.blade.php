@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order History</h1>
                    <p class="mt-2 text-sm text-gray-600">View all customer orders</p>
                </div>
                <div class="relative">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search orders..." 
                           class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th> <!-- Add Products Column -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="ordersTableBody">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $order->order_id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @foreach(json_decode($order->products, true) as $product)
                                            <span>{{ $product['name'] }} (x{{ $product['quantity'] }}) - ${{ $product['price'] }}</span><br>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-shopping-cart text-4xl mb-3"></i>
                                        <p class="text-lg font-medium">No orders found</p>
                                        <p class="text-sm">Customer orders will appear here</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </a>
                    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ $orders->firstItem() ?? 0 }}</span>
                            to
                            <span class="font-medium">{{ $orders->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-medium">{{ $orders->total() }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;

    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchOrders({ search: e.target.value });
        }, 500);
    });

    // Fetch orders with search
    function fetchOrders(params = {}) {
        const queryString = new URLSearchParams(params).toString();
        fetch(`/purchase-history?${queryString}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('ordersTableBody').innerHTML = data.view;
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection