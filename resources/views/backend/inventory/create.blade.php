@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Inventory</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backend.inventories.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_quantity">Product Quantity</label>
                            <input type="number" class="form-control" id="product_quantity" name="product_quantity"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Inventory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection