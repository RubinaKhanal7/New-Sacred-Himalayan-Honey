@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        @isset($error)
            <div class="alert alert-danger">{{ $error }}</div>
        @else
            <h1>Customers</h1>

            <a href="{{ route('backend.customers.create') }}" class="btn btn-primary mb-3">Create Customer</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($customers))
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->username }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <a href="{{ route('backend.customers.edit', $customer) }}" class="btn btn-warning">Edit</a>


                                    <form action="{{ route('backend.customers.destroy', $customer->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No customers found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endisset
    </div>
@endsection
