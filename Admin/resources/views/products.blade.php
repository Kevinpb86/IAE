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
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection