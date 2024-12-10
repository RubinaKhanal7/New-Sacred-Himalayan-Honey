
@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Coupon</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backend.coupons.update', $coupon->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="coupon_code">Coupon Code</label>
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ $coupon->coupon_code }}" required>
                        </div>

                        <div class="form-group">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" class="form-control" id="discount_amount" name="discount_amount" value="{{ $coupon->discount_amount }}" required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $coupon->start_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $coupon->end_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <select class="form-control" id="is_active" name="is_active" required>
                                <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

