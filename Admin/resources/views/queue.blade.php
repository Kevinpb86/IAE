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

        <!-- Main Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Address</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone Number</th>
                            <th class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr id="loading-row" class="hidden">
                            <td colspan="8" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
                                    <p class="text-gray-600">Loading orders...</p>
                                </div>
                            </td>
                        </tr>
                        <tr id="empty-row" class="hidden">
                            <td colspan="8" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="text-gray-400 mb-4">
                                        <i class="fas fa-inbox text-4xl"></i>
                                    </div>
                                    <p class="text-gray-600">No orders found</p>
                                    <p class="text-sm text-gray-500 mt-2">Orders will appear here when they are placed</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingRow = document.getElementById('loading-row');
        const emptyRow = document.getElementById('empty-row');
        const tbody = document.querySelector('tbody');

        // Show loading state initially
        tbody.innerHTML = '';
        loadingRow.classList.remove('hidden');
        emptyRow.classList.add('hidden');

        // Fetch data from API
        fetch('http://localhost:8000/api/queue')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Hide loading state
                loadingRow.classList.add('hidden');

                if (!data || data.length === 0) {
                    // Show empty state if no data
                    emptyRow.classList.remove('hidden');
                    return;
                }

                // Clear the tbody
                tbody.innerHTML = '';

                // Populate table with data
                data.forEach(order => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50 transition-colors duration-200';
                    row.innerHTML = `
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.id || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.customer_name || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.customer_email || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.item_name || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.item_quantity || ''}</td>
                        <td class="px-8 py-5 text-sm text-gray-900 max-w-xs break-words">${order.address || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.phone_number || ''}</td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900">${order.total_price || ''}</td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching queue data:', error);
                loadingRow.classList.add('hidden');
                emptyRow.classList.remove('hidden');
                // Add error message to the empty state
                const errorMessage = document.createElement('p');
                errorMessage.className = 'text-red-500 mt-2';
                errorMessage.textContent = 'Failed to load data. Please try again later.';
                emptyRow.querySelector('.flex.flex-col').appendChild(errorMessage);
            });
    });
</script>
@endsection 