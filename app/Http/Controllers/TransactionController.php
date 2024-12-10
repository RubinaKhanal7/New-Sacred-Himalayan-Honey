<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'order', 'payment'])->get();
        return view('backend.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $orders = Order::all();
        $payments = Payment::all();
        return view('backend.transaction.create', compact('customers', 'orders', 'payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
            'payment_id' => 'required|exists:payments,id',
            'status' => 'required|string|max:255',
        ]);

        Transaction::create($request->all());

        return redirect()->route('backend.transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $orders = Order::all();
        $payments = Payment::all();
        return view('backend.transaction.update', compact('transaction', 'users', 'orders', 'payments'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
            'payment_id' => 'required|exists:payments,id',
            'status' => 'required|string|max:255',
        ]);

        $transaction->update($request->all());

        return redirect()->route('backend.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('backend.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
