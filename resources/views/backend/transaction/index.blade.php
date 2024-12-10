@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Transactions</h1>
    <a href="{{ route('backend.transactions.create') }}" class="btn btn-primary mb-3">Add Transaction</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Order</th>
                <th>Amount</th>
                <th>Transaction Date</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->order->id }}</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->transaction_date->format('Y-m-d') }}</td>
                    <td>{{ $transaction->payment->id }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>
                        <a href="{{ route('backend.transactions.edit', $transaction->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('backend.transactions.destroy', $transaction->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
