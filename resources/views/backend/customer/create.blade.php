@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Create Customer</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <form action="{{ route('backend.customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" name="country" class="form-control">
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code:</label>
                <input type="text" name="postal_code" class="form-control">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" class="form-control">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" class="form-control">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
