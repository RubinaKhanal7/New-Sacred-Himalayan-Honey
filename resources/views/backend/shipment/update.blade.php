@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Shipment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backend.shipments.update', $shipment->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="order_id">Order ID</label>
                            <input type="text" class="form-control" id="order_id" name="order_id"
                                value="{{ $shipment->order_id }}" required>
                        </div>

                        <div class="form-group">
                            <label for="shipment_date">Shipment Date</label>
                            <input type="date" class="form-control" id="shipment_date" name="shipment_date"
                                value="{{ $shipment->shipment_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="carrier">Carrier</label>
                            <input type="text" class="form-control" id="carrier" name="carrier"
                                value="{{ $shipment->carrier }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number"
                                value="{{ $shipment->tracking_number }}" required>
                        </div>

                        <div class="form-group">
                            <label for="shipping_cost">Shipping Cost</label>
                            <input type="number" class="form-control" id="shipping_cost" name="shipping_cost"
                                value="{{ $shipment->shipping_cost }}" required>
                        </div>

                        <div class="form-group">
                            <label for="delivery_date">Delivery Date</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                                value="{{ $shipment->delivery_date }}">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="shipped" {{ $shipment->status == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Shipment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
