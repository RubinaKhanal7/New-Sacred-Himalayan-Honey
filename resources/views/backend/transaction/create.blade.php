@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Create Transaction</h1>
    <form action="{{ route('backend.transactions.store') }}" method="POST">
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
            <label for="order_id">Order</label>
            <select name="order_id" id="order_id" class="form-control">
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="transaction_date">Transaction Date</label>
            <input type="date" name="transaction_date" id="transaction_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="payment_id">Payment</label>
            <select name="payment_id" id="payment_id" class="form-control">
                @foreach ($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
</div>
@endsection