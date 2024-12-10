@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Shipments</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Shipment Date</th>
                                    <th scope="col">Carrier</th>
                                    <th scope="col">Tracking Number</th>
                                    <th scope="col">Shipping Cost</th>
                                    <th scope="col">Delivery Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shipments as $shipment)
                                    <tr>
                                        <td>{{ $shipment->id }}</td>
                                        <td>{{ $shipment->order_id }}</td>
                                        <td>{{ $shipment->shipment_date }}</td>
                                        <td>{{ $shipment->carrier }}</td>
                                        <td>{{ $shipment->tracking_number }}</td>
                                        <td>{{ $shipment->shipping_cost }}</td>
                                        <td>{{ $shipment->delivery_date }}</td>
                                        <td>{{ $shipment->status }}</td>
                                        <td>
                                            <a href="{{ route('backend.shipments.edit', $shipment->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('backend.shipments.destroy', $shipment->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this shipment?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection