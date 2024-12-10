@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Create Order</h1>

        <form action="{{ route('backend.orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Customer</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount</label>
                <input type="number" name="total_amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <select name="payment_status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>


            <div class="form-group">
                <label for="order_status">Order Status</label>
                <select name="order_status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>



            <div class="form-group">
                <label for="shipping_address">Shipping Address</label>
                <input type="text" name="shipping_address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="shipping_country">Shipping Country</label>
                <input type="text" name="shipping_country" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="shipping_cost">Shipping Cost</label>
                <input type="number" name="shipping_cost" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tax_amount">Tax Amount</label>
                <input type="number" name="tax_amount" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="delivery_date">Delivery Date</label>
                <input type="date" name="delivery_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="delivery_time">Delivery Time</label>
                <input type="time" name="delivery_time" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
