@extends('layouts.app')

@section('content')
<!-- Main Content Wrapper -->
<div class="content-wrapper">
    <div class="container-fluid py-4">
        <!-- Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-primary mb-0">Customer Order Management</h2>
                <p class="text-muted">Search, view and manage customer orders</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column - Search and Results -->
            <div class="col-lg-4">
                <!-- Search Section -->
                <div class="card shadow-sm rounded-3 mb-4"> <!-- Removed border-0 and added shadow-sm -->
                    <div class="card-header bg-primary text-white py-3"> <!-- Using Bootstrap's primary color -->
                        <h5 class="card-title mb-0">
                            <i class="bi bi-search me-2"></i>Find Customer
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('order.customer') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" id="search" name="search"
                                    class="form-control form-control-lg border-end-0"
                                    placeholder="Enter customer name..." value="{{ old('search') }}" required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            @error('search')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </form>
                    </div>
                </div>

                <!-- Customer Search Results Section -->
                @if (isset($customers))
                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center py-3">
                        <!-- Using Bootstrap's secondary color -->
                        <h5 class="card-title mb-0">
                            <i class="bi bi-people-fill me-2"></i>Search Results
                        </h5>
                        <button class="btn btn-sm btn-outline-light rounded-pill" id="toogle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#customer-data">
                            <!-- Changed to outline-light -->
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                    <div class="card-body p-0  show" id="customer-data"> 
                        @if(count($customers) > 0)
                        <div class="list-group list-group-flush">
                            @foreach ($customers as $customer)
                            <button type="button"
                                class="list-group-item list-group-item-action d-flex align-items-center p-3 customer-item"
                                onclick="GetOrders('{{ $customer->id }}')"> <!-- Added customer-item class -->
                                <div class="bg-light rounded-circle text-primary p-2 me-3">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <span class="fw-medium">{{ $customer->first_name }}</span>
                            </button>
                            @endforeach
                        </div>
                        @else
                        <div class="p-4 text-center">
                            <div class="text-warning mb-2">
                                <i class="bi bi-exclamation-triangle-fill fs-3"></i>
                            </div>
                            <p class="mb-0">No customer found with this name.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Orders and Details -->
            <div class="col-lg-8">
                <!-- Order List Section -->
                <div class="card shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-dark text-white py-3"> <!-- Using Bootstrap's dark color -->
                        <h5 class="card-title mb-0">
                            <i class="bi bi-clipboard-check me-2"></i>Order List
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light"> <!-- Using table-light for a cleaner look -->
                                    <tr>
                                        <th class="ps-4">Order #</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody id="orders-data" class="cursor-pointer">
                                    <!-- Order data will be populated here -->
                                </tbody>
                            </table>
                        </div>
                        <div id="no-orders" class="text-center p-4 d-none">
                            <div class="text-muted mb-2">
                                <i class="bi bi-inbox fs-1"></i>
                            </div>
                            <p>Select a customer to view their orders</p>
                        </div>
                    </div>
                </div>

                <!-- Order Details Section -->
                <div class="card shadow-sm rounded-3">
                    <div class="card-header bg-info text-white py-3"> <!-- Using Bootstrap's info color -->
                        <h5 class="card-title mb-0">
                            <i class="bi bi-cart-check me-2"></i>Order Details
                        </h5>
                    </div>
                    <div class="card-body p-0 order-data">
                        <div class="text-center p-5">
                            <div class="text-muted mb-2">
                                <i class="bi bi-basket3 fs-1"></i>
                            </div>
                            <p>Select an order to view details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    /* Footer styling */
    html {
        position: relative;
        min-height: 100%;
    }

    body {
        margin-bottom: 60px;
        /* Height of the footer */
    }

    .content-wrapper {
        min-height: calc(100vh - 160px);
        /* 100vh - (footer height + extra space) */
        padding-bottom: 30px;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        /* Set the fixed height of the footer here */
    }

    /* Custom styles */
    .cursor-pointer {
        cursor: pointer;
    }

    .table>tbody>tr {
        transition: background-color 0.2s;
    }

    .table>tbody>tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }


    /* Customer List Hover Effect */
    .customer-item:hover {
        background-color: rgba(0, 0, 0, 0.03);
        /* Lighten the background */
        cursor: pointer;
    }

    /* Smooth transitions */
    .order-data,
    #customer-data {
        transition: all 0.3s ease;
    }
</style>

<script>
    // Fetch orders for a specific customer
    function GetOrders(CustomerId) {
        $('.order-data').html('');
        const order_data = document.getElementById('orders-data');
        order_data.innerHTML = '';
        let html = '';
        axios.get(`/api/orders/customer/${CustomerId}`).then(response => {
            if (response.data && response.data.length > 0) {
                response.data.forEach(order => {
                    html +=
                        `<tr onclick='GetOrderDetail(${order.id})'><td class="ps-4">#${order.id}</td><td>${order.order_date}</td></tr>`
                })
                order_data.innerHTML = html;
                $('#no-orders').addClass('d-none');
            } else {
                $('#no-orders').removeClass('d-none');
            }
        }).catch((err) => {
            console.log(err.message)
        })
    }

    // Toggle customer data visibility
    // $('#toogle-btn').on('click', (e) => {
    //     $('#customer-data').collapse('toggle')
    // })

    // Fetch order details
    function GetOrderDetail(OrderId) {
        axios.get(`/api/order/${OrderId}/data`).then(response => {
            if (response.data && response.data.length > 0) {
                $('.order-data').html('');
                let html =
                    '<div class="table-responsive"><table class="table table-striped mb-0"><thead class="table-light"><tr><th class="ps-4">Product Name</th><th>Price</th></tr></thead><tbody>';
                response.data.forEach(product => {
                    html += `<tr><td class="ps-4">${product.name}</td><td>${product.price}</td></tr>`
                })
                html += '</tbody></table></div>';
                $('.order-data').html(html);
            } else {
                $('.order-data').html(
                    '<div class="text-center p-4"><div class="text-muted mb-2"><i class="bi bi-bag-x fs-1"></i></div><p class="mb-0">No products found for this order</p></div>'
                );
            }
        }).catch((err) => {
            console.log(err.message)
        })
    }
</script>

@endsection