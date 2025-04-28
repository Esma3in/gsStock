@extends('layouts.app')

@section('content')
    <!-- Main Content Section -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">@lang('Stock Management')</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="/clients" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-person-fill me-2"></i>
                                    @lang('Clients List')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/suppliers" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-truck me-2"></i>
                                    @lang('Suppliers List')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/products" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-box-seam me-2"></i>
                                    @lang('Products List')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/getProductByCat" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-tags-fill me-2"></i>
                                    @lang('Products by Category')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/getProductBySupp" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-truck-front-fill me-2"></i>
                                    @lang('Products by Supplier')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/getProStore" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-shop me-2"></i>
                                    @lang('Products by Store')
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="/orders" class="text-decoration-none d-flex align-items-center">
                                    <i class="bi bi-cart-fill me-2"></i>
                                    @lang('Orders by Customers')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>
@endsection