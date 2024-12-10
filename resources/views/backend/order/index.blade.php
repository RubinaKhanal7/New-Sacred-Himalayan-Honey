@extends('layouts2.superadmin')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        <table id="ordersTable" class="table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($combinedOrders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->user_id ? ($order->customer->first_name ?? 'Registered User') : 'Guest' }}</td>
                        <td>{{ $order->user_name ?? $order->customer->first_name ?? 'Guest' }}</td>
                        <td>{{ $order->user_email ?? $order->customer->email ?? ($order->email ?? 'N/A') }}</td>
                        <td>
                            @if(isset($order->products) && $order->products->isNotEmpty())
                                @foreach($order->products as $product)
                                    <div>{{ $product->product_name }}</div>
                                @endforeach
                            @elseif(isset($order->product))
                                <div>{{ $order->product->product_name }}</div>
                            @else
                                <div>Product not found</div>
                            @endif
                        </td>
                        <td>
                            @if(isset($order->products) && $order->products->isNotEmpty())
                                @foreach($order->products as $product)
                                    <div>{{ $product->pivot->quantity ?? 'N/A' }}</div>
                                @endforeach
                            @elseif(isset($order->quantity))
                                <div>{{ $order->quantity }}</div>
                            @else
                                <div>Quantity not available</div>
                            @endif
                        </td>
                        <td>{{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td class="text-success">{{ ucfirst($order->payment_status) }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <form action="{{ route('backend.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div id="paginationControls" class="d-flex justify-content-end"></div>
    </div>

    {{-- Optional CSS for Pagination Buttons --}}
    <style>
        #paginationControls .btn {
            margin: 0 5px;
        }

        #paginationControls .btn-success {
            background-color: green;
            border-color: green;
        }
    </style>

    {{-- JavaScript for Client-Side Pagination --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rowsPerPage = 20;
            const table = document.getElementById("ordersTable").getElementsByTagName("tbody")[0];
            const rows = table.getElementsByTagName("tr");
            const paginationControls = document.getElementById("paginationControls");

            let currentPage = 1;
            const totalPages = Math.ceil(rows.length / rowsPerPage);

            function displayPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                for (let i = 0; i < rows.length; i++) {
                    if (i >= start && i < end) {
                        rows[i].style.display = "";
                        rows[i].getElementsByTagName("td")[0].innerText = (i + 1) - start + (currentPage - 1) * rowsPerPage; // Update SN column
                    } else {
                        rows[i].style.display = "none";
                    }
                }

                updatePaginationControls();
            }

            function updatePaginationControls() {
                paginationControls.innerHTML = "";

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.innerText = i;
                    button.classList.add("btn", "btn-primary", "mx-1");
                    if (i === currentPage) {
                        button.classList.add("btn-success");
                    }
                    button.addEventListener("click", function () {
                        currentPage = i;
                        displayPage(currentPage);
                    });
                    paginationControls.appendChild(button);
                }
            }

            displayPage(currentPage);
        });
    </script>
@endsection
