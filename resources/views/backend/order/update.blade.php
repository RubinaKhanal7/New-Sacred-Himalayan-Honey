@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('backend.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $order->user_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            
            <div class="form-group">
                <label for="order_date">Order</label>
                <input type="text" name="order_id" class="form-control" value="{{ $order->id }}" required>
            </div>

            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" class="form-control" value="{{ $order->order_date }}" required>
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" class="form-control" value="{{ $order->total_amount }}" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" class="form-control" value="{{ $order->payment_method }}">
            </div>

            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <input type="text" name="payment_status" class="form-control" value="{{ $order->payment_status }}">
            </div>

            <div class="form-group">
                <label for="shipping_address">Shipping Address</label>
                <input type="text" name="shipping_address" class="form-control" value="{{ $order->shipping_address }}">
            </div>

            <div class="form-group">
                <label for="shipping_country">Shipping Country</label>
                <input type="text" name="shipping_country" class="form-control" value="{{ $order->shipping_country }}">
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ $order->postal_code }}">
            </div>

            <div class="form-group">
                <label for="shipping_cost">Shipping Cost</label>
                <input type="number" name="shipping_cost" class="form-control" value="{{ $order->shipping_cost }}">
            </div>

            <div class="form-group">
                <label for="tax_amount">Tax Amount</label>
                <input type="number" name="tax_amount" class="form-control" value="{{ $order->tax_amount }}">
            </div>

            <div class="form-group">
                <label for="order_status">Order Status</label>
                <input type="text" name="order_status" class="form-control" value="{{ $order->order_status }}">
            </div>

            <div class="form-group">
                <label for="is_paid">Is Paid</label>
                <input type="checkbox" name="is_paid" {{ $order->is_paid ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="is_shipped">Is Shipped</label>
                <input type="checkbox" name="is_shipped" {{ $order->is_shipped ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="is_delivered">Is Delivered</label>
                <input type="checkbox" name="is_delivered" {{ $order->is_delivered ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="delivery_date">Delivery Date</label>
                <input type="date" name="delivery_date" class="form-control" value="{{ $order->delivery_date }}">
            </div>

            <div class="form-group">
                <label for="delivery_time">Delivery Time</label>
                <input type="time" name="delivery_time" class="form-control" value="{{ $order->delivery_time }}">
            </div>

            <!-- Add more input fields for other order attributes if needed -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
