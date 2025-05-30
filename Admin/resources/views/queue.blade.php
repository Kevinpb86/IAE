@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-10 bg-white rounded-3xl shadow-sm p-10 border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-6 md:space-y-0">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Queue Management</h1>
                    <p class="mt-3 text-sm text-gray-600">View and manage all queued orders</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                    <div class="relative flex-grow sm:flex-grow-0">
                        <input type="text" 
                               placeholder="Search queue..." 
                               class="w-full sm:w-80 pl-12 pr-4 py-3.5 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-lg"></i>
                        </div>
                    </div>
                    <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3.5 rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex items-center justify-center shadow-sm hover:shadow-md">
                        <i class="fas fa-filter mr-3 text-lg"></i>
                        Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total in Queue</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">8</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-green-100 to-green-50 text-green-600">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Processed Today</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-yellow-100 to-yellow-50 text-yellow-600">
                        <i class="fas fa-hourglass-half text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Average Wait Time</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">15 min</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-100 to-purple-50 text-purple-600">
                        <i class="fas fa-tasks text-2xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Processing Rate</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">4/hr</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Items</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Wait Time</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">#ORD-001</div>
                                <div class="text-xs text-gray-500 mt-1">Added 5 min ago</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-600">JD</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                                        <div class="text-xs text-gray-500 mt-1">john@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm text-gray-900">Nike Air Max (2)</div>
                                <div class="text-xs text-gray-500 mt-1">Total: $299.98</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-500">
                                5 minutes
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                                <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mr-3 shadow-sm hover:shadow">
                                    Process
                                </button>
                                <button class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2.5 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-sm hover:shadow">
                                    Cancel
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">#ORD-002</div>
                                <div class="text-xs text-gray-500 mt-1">Added 12 min ago</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center">
                                        <span class="text-sm font-medium text-green-600">JS</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                        <div class="text-xs text-gray-500 mt-1">jane@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm text-gray-900">Adidas T-Shirt (1)</div>
                                <div class="text-xs text-gray-500 mt-1">Total: $49.99</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800">
                                    Processing
                                </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-500">
                                12 minutes
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                                <button class="bg-gradient-to-r from-green-600 to-green-700 text-white px-5 py-2.5 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 mr-3 shadow-sm hover:shadow">
                                    Complete
                                </button>
                                <button class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2.5 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-sm hover:shadow">
                                    Cancel
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="px-8 py-6 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">#ORD-003</div>
                                <div class="text-xs text-gray-500 mt-1">Added 18 min ago</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                                        <span class="text-sm font-medium text-purple-600">MJ</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Mike Johnson</div>
                                        <div class="text-xs text-gray-500 mt-1">mike@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm text-gray-900">Puma Shoes (1)</div>
                                <div class="text-xs text-gray-500 mt-1">Total: $89.99</div>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap">
                                <span class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800">
                                    Pending
                                </span>
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-500">
                                18 minutes
                            </td>
                            <td class="px-8 py-6 whitespace-nowrap text-sm font-medium">
                                <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 mr-3 shadow-sm hover:shadow">
                                    Process
                                </button>
                                <button class="bg-gradient-to-r from-red-600 to-red-700 text-white px-5 py-2.5 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-sm hover:shadow">
                                    Cancel
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.querySelector('input[placeholder="Search queue..."]');
    let searchTimeout;

    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Implement search functionality
            console.log('Searching for:', e.target.value);
        }, 500);
    });
</script>
@endsection 