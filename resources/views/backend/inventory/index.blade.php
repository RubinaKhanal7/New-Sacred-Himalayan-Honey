@extends('layouts2.superadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inventory</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <td>{{ $item->product->id }}</td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td>
                                        <a href="{{ route('backend.inventories.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('backend.inventories.destroy', $item->id) }}"
                                            method="POST" style="display: inline;">
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