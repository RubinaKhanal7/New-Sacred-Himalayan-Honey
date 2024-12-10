@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Edit Transaction</h1>
    <form action="{{ route('backend.transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="order_id">Order</label>
            <select name="order_id" id="order_id" class="form-control">
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}" {{ $transaction->order_id == $order->id ? 'selected' : '' }}>
                        {{ $order->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}"
                required>
        </div>
        <div class="form-group">
            <label for="transaction_date">Transaction Date</label>
            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                value="{{ $transaction->transaction_date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label for="payment_id">Payment</label>
            <select name="payment_id" id="payment_id" class="form-control">
                @foreach ($payments as $payment)
                    <option value="{{ $payment->id }}"
                        {{ $transaction->payment_id == $payment->id ? 'selected' : '' }}>
                        {{ $payment->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $transaction->status }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Update Transaction</button>
    </form>
</div>
@endsection
