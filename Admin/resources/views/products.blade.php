@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 mt-10 text-center">Products List Page</h1>

<div class="overflow-x-auto px-25">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Image</th>
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
            @foreach ($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="h-10 w-10 object-cover rounded-full">
                    @else
                        No Image
                    @endif
                </td>
                <td class="py-3 px-6 text-left">{{ $product->product_name }}</td>
                <td class="py-3 px-6 text-left">{{ $product->category }}</td>
                <td class="py-3 px-6 text-left">{{ $product->gender }}</td>
                <td class="py-3 px-6 text-left">{{ $product->size }}</td>
                <td class="py-3 px-6 text-left">${{ number_format($product->price, 2) }}</td>
                <td class="py-3 px-6 text-left">{{ $product->stock }}</td>
                <td class="py-3 px-6 text-center">
                    <button type="button" 
                            class="text-blue-600 hover:text-blue-900 cursor-pointer edit-btn" 
                            data-product-id="{{ $product->id }}">
                        Edit
                    </button>
                    <span class="text-gray-400"> | </span>
                    <button type="button" 
                            class="text-red-600 hover:text-red-900 cursor-pointer delete-btn" 
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->product_name }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-btn');
    
    // Open edit popup
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            
            // Fetch product data
            fetch(`/products/${productId}/edit`)
                .then(response => response.json())
                .then(product => {
                    // Create form HTML
                    const formHtml = `
                        <form id="editForm" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_product_id" name="product_id" value="${product.id}">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                <input type="text" id="edit_product_name" name="product_name" value="${product.product_name}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <select id="edit_product_gender" name="product_gender" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="male" ${product.gender === 'male' ? 'selected' : ''}>Male</option>
                                    <option value="female" ${product.gender === 'female' ? 'selected' : ''}>Female</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <input type="text" id="edit_product_category" name="product_category" value="${product.category}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input type="number" step="0.01" id="edit_product_price" name="product_price" value="${product.price}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                                <input type="number" id="edit_product_stock" name="product_stock" value="${product.stock}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sizes</label>
                                <div class="space-y-2">
                                    ${['S', 'M', 'L', 'XL'].map(size => `
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="sizes[]" value="${size}" 
                                                ${product.size.split(',').includes(size) ? 'checked' : ''}
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <span class="ml-2">${size}</span>
                                        </label>
                                    `).join('')}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                                <input type="file" id="edit_product_image" name="product_image" 
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>
                        </form>
                    `;

                    // Show SweetAlert2 popup
                    Swal.fire({
                        title: 'Edit Product',
                        html: formHtml,
                        showCancelButton: true,
                        confirmButtonText: 'Save Changes',
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            const form = document.getElementById('editForm');
                            const formData = new FormData(form);
                            
                            return fetch(`/products/${productId}`, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-HTTP-Method-Override': 'PUT'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.success) {
                                    throw new Error(data.message || 'Something went wrong');
                                }
                                return data;
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error}`);
                            });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Product updated successfully',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load product data.'
                    });
                });
        });
    });

    // Delete functionality
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            
            // First confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to delete "${productName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I want to delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Second confirmation
                    Swal.fire({
                        title: 'One more step!',
                        text: "Please type 'DELETE' to confirm deletion",
                        icon: 'warning',
                        input: 'text',
                        inputPlaceholder: 'Type DELETE here',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        inputValidator: (value) => {
                            if (value !== 'DELETE') {
                                return 'Please type DELETE to confirm';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Create and submit the form
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/products/${productId}`;
                            
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            
                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                }
            });
        });
    });
});
</script>
@endpush

@endsection