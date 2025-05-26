@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 mt-10 text-center">Products List Page</h1>

<div class="overflow-x-auto px-25">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Category</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Stock</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">1</td>
                <td class="py-3 px-6 text-left">Product A</td>
                <td class="py-3 px-6 text-left">Category 1</td>
                <td class="py-3 px-6 text-left">$10.00</td>
                <td class="py-3 px-6 text-left">100</td>
                <td class="py-3 px-6 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">2</td>
                <td class="py-3 px-6 text-left">Product B</td>
                <td class="py-3 px-6 text-left">Category 2</td>
                <td class="py-3 px-6 text-left">$20.00</td>
                <td class="py-3 px-6 text-left">50</td>
                <td class="py-3 px-6 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">3</td>
                <td class="py-3 px-6 text-left">Product C</td>
                <td class="py-3 px-6 text-left">Category 1</td>
                <td class="py-3 px-6 text-left">$15.00</td>
                <td class="py-3 px-6 text-left">75</td>
                <td class="py-3 px-6 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">4</td>
                <td class="py-3 px-6 text-left">Product D</td>
                <td class="py-3 px-6 text-left">Category 3</td>
                <td class="py-3 px-6 text-left">$30.00</td>
                <td class="py-3 px-6 text-left">20</td>
                <td class="py-3 px-6 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">5</td>
                <td class="py-3 px-6 text-left">Product E</td>
                <td class="py-3 px-6 text-left">Category 2</td>
                <td class="py-3 px-6 text-left">$25.00</td>
                <td class="py-3 px-6 text-left">60</td>
                <td class="py-3 px-6 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <span class="text-gray-400"> | </span>
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection