@extends('frontend.layouts.master')

@section('content')
<style>
    .order-summary {
        font-family: 'Arial', sans-serif;
        max-width: 800px;
        margin: 40px auto;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .order-header {
        background: #774421;
        color: white;
        padding: 20px;
        position: relative;
    }
    .order-header h1 {
        margin: 0;
        font-size: 24px;
    }
    .print-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        color: #3498db;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .print-btn:hover {
        background: #f1f1f1;
    }
    .order-content {
        padding: 30px;
    }
    .order-details, .product-list {
        background: white;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .order-details h2, .product-list h2 {
        color: #3498db;
        margin-top: 0;
        font-size: 20px;
    }
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .detail-label {
        font-weight: bold;
        color: #555;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    th {
        background: #f2f2f2;
        font-weight: bold;
        color: #333;
    }
    .total {
        text-align: right;
        font-size: 18px;
        font-weight: bold;
        color: #3498db;
        margin-top: 20px;
    }
    @media print {
        .print-btn, .order-header h1, h5 {
            display: none;
        }
        body * {
            visibility: hidden;
        }
        .order-summary, .order-details, .product-list, 
        .order-details *, .product-list *, .total {
            visibility: visible;
        }
        .order-summary {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>

<div class="order-summary">
    <div class="order-header">
        <h1>Order Summary</h1>
        <button onclick="window.print()" class="print-btn">Print</button>
    </div>
    <h5 style="color: #faa000; ">Print this for further use.</h5>
    <div class="order-content">
        @if(session('success_message'))
        <div class="alert alert-success">{{ session('success_message') }}</div>
        @endif

        <div class="order-details">
            <h2>Order Details</h2>
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                <span>{{ $order->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Customer Name:</span>
                <span>{{ $order->user_name ?? $order->customer->first_name . ' ' . $order->customer->last_name ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span>{{ $order->user_email ?? $order->customer->email ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Address:</span>
                <span>{{ $order->shipping_address }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Country:</span>
                <span>{{ $order->shipping_country }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Postal Code:</span>
                <span>{{ $order->postal_code }}</span>
            </div>
        </div>

        <div class="product-list">
            <h2>Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $productQuantities[$product->id] ?? 0 }}</td>
                            <td>${{ number_format($product->selling_price, 2) }}</td>
                            <td>${{ number_format(($productQuantities[$product->id] ?? 0) * $product->selling_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="total">
                Total Amount Paid: ${{ number_format($totalPrice, 2) }}
            </div>
        </div>
    </div>
</div>
@endsection
