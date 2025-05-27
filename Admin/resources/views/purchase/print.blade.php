<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $purchase->order_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f5f5f5;
        }
        .invoice-total {
            text-align: right;
            margin-top: 20px;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>Order ID: #{{ $purchase->order_id }}</p>
        <p>Date: {{ $purchase->created_at->format('F d, Y') }}</p>
    </div>

    <div class="invoice-details">
        <h3>Customer Information</h3>
        <p>Name: {{ $purchase->customer_name }}</p>
        <p>Email: {{ $purchase->customer_email }}</p>
        <p>Payment Method: {{ $purchase->payment_method }}</p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="invoice-total">
        <h3>Total Amount: ${{ number_format($purchase->amount, 2) }}</h3>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Print Invoice</button>
    </div>
</body>
</html> 