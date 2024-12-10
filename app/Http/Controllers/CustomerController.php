<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    try {
        $customers = Customer::all();
        return view('backend.customer.index', compact('customers'));
    } catch (Exception $e) {
        // Log the error for better tracking
        Log::error($e->getMessage());
        // Define an error message
        $errorMessage = 'An error occurred while fetching customers.';
        // Pass the error message to the view
        return view('backend.customer.index', ['error' => $errorMessage]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:customers',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
        ]);
    
        try {
            Customer::create($request->all());
    
            return redirect()->route('backend.customers.index')
                             ->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withErrors(['error' => 'An error occurred while creating the customer. Please try again.'])
                             ->withInput();
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
{
    return view('backend.customer.update', compact('customer'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:customers,username,' . $customer->id,
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
        ]);

        $customer->update($request->all());

        return redirect()->route('backend.customers.index')
                         ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('backend.customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}
