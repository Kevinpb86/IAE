@if($orders->isEmpty())
    <tr>
        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
            No orders found
        </td>
    </tr>
@else
    @foreach($orders as $order)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                    {{ $order->product_name }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $order->quantity }}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                <div class="text-sm text-gray-500">{{ $order->user->address }}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">{{ $order->user->phone }}</div>
                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">
                    {{ $order->additional_notes ?: 'No additional notes' }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button onclick="viewOrder({{ $order->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                    View
                </button>
                <button onclick="editOrder({{ $order->id }})" class="text-yellow-600 hover:text-yellow-900 mr-3">
                    Edit
                </button>
                <button onclick="deleteOrder({{ $order->id }})" class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </td>
        </tr>
    @endforeach
@endif 