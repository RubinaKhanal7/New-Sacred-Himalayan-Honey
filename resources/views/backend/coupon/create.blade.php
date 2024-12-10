@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <h1>Create Cart Item</h1>
                    <form method="POST" action="{{ route('backend.coupons.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="coupon_code">Coupon Code</label>
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
                        </div>

                        <div class="form-group">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <select class="form-control" id="is_active" name="is_active" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
