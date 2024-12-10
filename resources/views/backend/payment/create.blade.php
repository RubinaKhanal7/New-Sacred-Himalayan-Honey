@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h2>Create Payment</h2>

    <form action="{{ route('backend.payments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="order_id">Order ID</label>
            <select class="form-control" id="order_id" name="order_id" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <input type="text" name="payment_method" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="payment_status">Payment Status</label>
            <input type="text" name="payment_status" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection