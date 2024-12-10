@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Coupons</div>

                <div class="card-body">
                    <a href="{{ route('backend.coupons.create') }}" class="btn btn-primary mb-3">Add Cart Coupon</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Coupon Code</th>
                                <th scope="col">Discount Amount</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Is Active</th>
                                <th scope="col">Actions</th> <!-- Add this header for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>{{ $coupon->discount_amount }}</td>
                                <td>{{ $coupon->start_date->format('Y-m-d') }}</td>
                                <td>{{ $coupon->end_date->format('Y-m-d') }}</td>
                                <td>{{ $coupon->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('backend.coupons.edit', $coupon->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('backend.coupons.destroy', $coupon->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
@endsection
