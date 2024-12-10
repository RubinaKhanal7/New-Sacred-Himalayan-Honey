<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the shipments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all shipments
        $shipments = Shipment::all();
        
        // Return a view with the shipments data
        return view('backend.shipment.index', ['shipments' => $shipments]);
    }

    /**
     * Show the form for creating a new shipment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch all orders
        $orders = Order::all();
        
        // Return a view for creating a new shipment
        return view('backend.shipment.create', compact('orders'));
    }

    /**
     * Store a newly created shipment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shipment_date' => 'required|date',
            'carrier' => 'required|string',
            'tracking_number' => 'nullable|string',
            'shipping_cost' => 'required|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Create a new shipment
        Shipment::create($validatedData);

        // Redirect to the shipments index or do something else
        return redirect()->route('backend.shipments.index');
    }

    /**
     * Show the form for editing the specified shipment.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        // Return a view for editing the specified shipment
        return view('backend.shipment.edit', ['shipment' => $shipment]);
    }

    /**
     * Update the specified shipment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'shipment_date' => 'required|date',
            'carrier' => 'required|string',
            'tracking_number' => 'nullable|string',
            'shipping_cost' => 'required|numeric|min:0',
            'delivery_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Update the shipment
        $shipment->update($validatedData);

        // Redirect to the shipments index or do something else
        return redirect()->route('backend.shipments.index');
    }

    /**
     * Remove the specified shipment from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        // Delete the shipment
        $shipment->delete();

        // Redirect to the shipments index or do something else
        return redirect()->route('backend.shipments.index');
    }
}
