@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 mt-10 text-center">Products List Page</h1>

<div class="overflow-x-auto px-25">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Product Name</th>
                <th class="py-3 px-6 text-left">Category</th>
                <th class="py-3 px-6 text-left">Gender</th>
                <th class="py-3 px-6 text-left">Size</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Stock</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody" class="text-gray-600 text-sm font-light">
            <!-- Data will be loaded here dynamically -->
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchProducts();
});

function fetchProducts() {
    fetch('/api/products')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = ''; // Clear existing data

            data.forEach(product => {
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-200 hover:bg-gray-100';
                row.innerHTML = `
                    <td class="py-3 px-6 text-left">${product.product_name}</td>
                    <td class="py-3 px-6 text-left">${product.category}</td>
                    <td class="py-3 px-6 text-left">${product.gender}</td>
                    <td class="py-3 px-6 text-left">${product.size}</td>
                    <td class="py-3 px-6 text-left">$${product.price.toFixed(2)}</td>
                    <td class="py-3 px-6 text-left">${product.stock}</td>
                    <td class="py-3 px-6 text-center">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <span class="text-gray-400"> | </span>
                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="py-3 px-6 text-center text-red-600">
                        Error loading products. Please try again later.
                    </td>
                </tr>
            `;
        });
}
</script>
@endsection