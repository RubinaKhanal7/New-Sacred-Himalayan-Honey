@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h2>Edit Payment</h2>

        <form action="{{ route('backend.payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="order_id">Order ID</label>
                <input type="number" name="order_id" class="form-control" value="{{ $payment->order_id }}" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" value="{{ $payment->amount }}"
                    required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" class="form-control" value="{{ $payment->payment_method }}"
                    required>
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status</label>
                <input type="text" name="payment_status" class="form-control" value="{{ $payment->payment_status }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
