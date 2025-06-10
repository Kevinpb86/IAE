@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Purchase History</h1>
                    <p class="mt-2 text-sm text-gray-600">View and manage all purchase transactions</p>
                </div>
                <div class="flex space-x-3">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search purchases..." 
                               class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out flex items-center">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-150 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Purchases</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalPurchases ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-150 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Completed</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $completedPurchases ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-150 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pending</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $pendingPurchases ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition duration-150 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-dollar-sign text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                        <p class="text-2xl font-semibold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}</p>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($purchases as $purchase)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $purchase->order_id }}</div>
                                    <div class="text-xs text-gray-500">{{ $purchase->items_count ?? 0 }} items</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $purchase->customer_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $purchase->customer_email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">${{ number_format($purchase->amount, 2) }}</div>
                                    <div class="text-xs text-gray-500">{{ $purchase->payment_method ?? 'Credit Card' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-shopping-cart text-4xl mb-3"></i>
                                        <p class="text-lg font-medium">No purchase records found</p>
                                        <p class="text-sm">Start tracking your purchases to see them here</p>
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
                            <span class="font-medium">{{ $purchases->firstItem() ?? 0 }}</span>
                            to
                            <span class="font-medium">{{ $purchases->lastItem() ?? 0 }}</span>
                            of
                            <span class="font-medium">{{ $purchases->total() }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewPurchase(id) {
        fetch(`/purchase-history/${id}`)
            .then(response => response.json())
            .then(data => {
                // Implement view modal
                console.log('Viewing purchase:', data);
            })
            .catch(error => console.error('Error:', error));
    }

    function downloadPurchase(id) {
        window.location.href = `/purchase-history/${id}/download`;
    }

    function printPurchase(id) {
        const printWindow = window.open(`/purchase-history/${id}/print`, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Search purchases..."]');
    let searchTimeout;

    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchPurchases({ search: e.target.value });
        }, 500);
    });

    function fetchPurchases(params = {}) {
        const queryString = new URLSearchParams(params).toString();
        fetch(`/purchase-history?${queryString}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('tbody').innerHTML = data.view;
            updatePagination(data.purchases);
        })
        .catch(error => console.error('Error:', error));
    }

    function updatePagination(purchases) {
        const paginationContainer = document.querySelector('.pagination');
        if (paginationContainer) {
            paginationContainer.innerHTML = purchases.links;
        }
    }
</script>
@endsection 