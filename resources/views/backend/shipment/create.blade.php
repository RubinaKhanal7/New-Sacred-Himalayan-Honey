@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Shipment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backend.shipments.store') }}">
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
                            <label for="shipment_date">Shipment Date</label>
                            <input type="date" class="form-control" id="shipment_date" name="shipment_date" required>
                        </div>

                        <div class="form-group">
                            <label for="carrier">Carrier</label>
                            <input type="text" class="form-control" id="carrier" name="carrier" required>
                        </div>

                        <div class="form-group">
                            <label for="tracking_number">Tracking Number</label>
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="shipping_cost">Shipping Cost</label>
                            <input type="number" class="form-control" id="shipping_cost" name="shipping_cost" required>
                        </div>

                        <div class="form-group">
                            <label for="delivery_date">Delivery Date</label>
                            <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Shipment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
