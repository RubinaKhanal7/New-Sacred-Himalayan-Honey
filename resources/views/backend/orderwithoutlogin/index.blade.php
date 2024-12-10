@extends('layouts2.superadmin')

@section('content')
<div class="container">
    @isset($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @else
        <h1>Orders</h1>

        {{-- <a href="{{ route('backend.orders.create') }}" class="btn btn-primary mb-3">Create Order</a> --}}

        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $ordersWithoutLogin as $order)
                        <tr>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->user_email }}</td>
                            <td>
                                @php
                                    $product = \App\Models\Product::find($order->product_id);
                                @endphp
                                <div>
                                    {{ $product ? $product->product_name : 'Product not found' }}
                                </div>
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td class="text-success">{{ $order->payment_status }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>
                                <a href="{{ route('backend.orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('backend.orders.destroy', $order->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="9">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @endisset
</div>
@endsection