@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Purchase History</h1>
                <p class="mt-1 text-sm text-gray-500">View and manage all purchase transactions</p>
            </div>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search purchases..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
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
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
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
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
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
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
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
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($purchases as $purchase)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
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
                                <div class="text-sm text-gray-900">{{ $purchase->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $purchase->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($purchase->amount, 2) }}</div>
                                <div class="text-xs text-gray-500">{{ $purchase->payment_method ?? 'Credit Card' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($purchase->status === 'completed') bg-green-100 text-green-800
                                    @elseif($purchase->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($purchase->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center space-x-3">
                                    <button onclick="viewPurchase({{ $purchase->id }})" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="downloadPurchase({{ $purchase->id }})" class="text-gray-600 hover:text-gray-900 transition-colors duration-200" title="Download Invoice">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button onclick="printPurchase({{ $purchase->id }})" class="text-gray-600 hover:text-gray-900 transition-colors duration-200" title="Print Invoice">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center">
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

<style>
    /* Custom styles for better visual appeal */
    .container {
        max-width: 1280px;
    }
    
    /* Smooth transitions */
    .transition-colors {
        transition-property: background-color, border-color, color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
    
    /* Hover effects */
    .hover\:bg-gray-50:hover {
        background-color: rgba(249, 250, 251, 1);
    }
    
    /* Shadow effects */
    .shadow-sm {
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    
    /* Status badge styles */
    .rounded-full {
        border-radius: 9999px;
    }
    
    /* Table styles */
    .divide-y > :not([hidden]) ~ :not([hidden]) {
        --tw-divide-y-reverse: 0;
        border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse)));
        border-bottom-width: calc(1px * var(--tw-divide-y-reverse));
    }
    
    /* Responsive design */
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
</style>

<script>
    function viewPurchase(id) {
        // Implement view purchase details
        console.log('Viewing purchase:', id);
    }

    function downloadPurchase(id) {
        // Implement download invoice
        console.log('Downloading purchase:', id);
    }

    function printPurchase(id) {
        // Implement print invoice
        console.log('Printing purchase:', id);
    }
</script>
@endsection 