@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Edit Customer</h1>

        <form action="{{ route('backend.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $customer->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $customer->last_name }}" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="{{ $customer->username }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current password)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" value="{{ $customer->country }}">
            </div>

            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ $customer->postal_code }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $customer->phone_number }}">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ $customer->date_of_birth }}">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select</option>
                    <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $customer->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
