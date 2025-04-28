@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0">Product List</h2>
            <a class="btn btn-warning float-end" href="{{ route('products.export') }}"><i class="fa fa-download"></i> Export Products Data</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#importProductModal">
                    <i class="fa fa-file"></i> Import
        </button>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-success d-flex align-items-center gap-2" data-bs-toggle="modal"
                    data-bs-target="#createProductModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Add New Product
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                    <svg class="bi" width="16" height="16" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search products..."
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Supplier</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><img width="100px" height="100px" src={{$product->image}} alt="image"></td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock->quantity_stock ?? 0 }}</td>
                            <td>{{ $product->supplier->first_name }} {{ $product->supplier->last_name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary edit-product"
                                        data-id="{{ $product->id }}" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete-product"
                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                @if($products->lastPage() > 1)
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{-- Previous page link --}}
                        @if($products->currentPage() > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->url($products->currentPage() - 1) }}"
                                data-page="{{ $products->currentPage() - 1 }}">
                                <<< /a>
                        </li>
                        @endif

                        {{-- Page numbers --}}
                        @for($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $i === $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}" data-page="{{ $i }}">{{ $i }}</a>
                            </li>
                            @endfor

                            {{-- Next page link --}}
                            @if($products->currentPage() < $products->lastPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->url($products->currentPage() + 1) }}"
                                        data-page="{{ $products->currentPage() + 1 }}">>></a>
                                </li>
                                @endif
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </div>
</div>

@include('products.partials.create-modal')
@include('products.partials.edit-modal')
@include('products.partials.delete-modal')
@include('products.partials.import-modal')

@push('scripts')
<script>
    $(document).ready(function() {
    function loadProducts(page = 1, search = '') {
        $.ajax({
            url: '{{ route("products.index") }}',
            type: 'GET',
            data: {
                page: page,
                search: search
            },
            success: function(response) {
                let products = response.products;
                let tbody = $('#productsTableBody');
                tbody.empty();

                products.forEach(function(product) {
                    tbody.append(`
                        <tr>
                            <td>${product.name}</td>
                            <td><img src=${product.image} alt ='image alternative' width= '100px' height='100px' </td>
                            <td>${product.category.name}</td>
                            <td>${product.description}</td>
                            <td>$${parseFloat(product.price).toFixed(2)}</td>
                            <td>${product.stock ? product.stock.quantity_stock : 0}</td>
                            <td>${product.supplier.first_name} ${product.supplier.last_name}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary edit-product" data-id="${product.id}" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete-product" data-id="${product.id}" data-name="${product.name}" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                });

                // Update pagination links
                let pagination = response.pagination;
                let paginationHtml = '';

                if (pagination.last_page > 1) {
                    paginationHtml += `<nav aria-label="Page navigation"><ul class="pagination mb-0">`;

                    // Previous page link
                    if (pagination.current_page > 1) {
                        paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${pagination.current_page - 1}"><<</a></li>`;
                    }

                    // Page numbers
                    for (let i = 1; i <= pagination.last_page; i++) {
                        paginationHtml += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                    }

                    // Next page link
                    if (pagination.current_page < pagination.last_page) {
                        paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${pagination.current_page + 1}">>></a></li>`;
                    }

                    paginationHtml += `</ul></nav>`;
                }

                $('.d-flex.justify-content-center.mt-4').html(paginationHtml);

                // Reattach event handlers
                attachEventHandlers();
            },
            error: function(xhr) {
                console.error('Error loading products:', xhr);
            }
        });
    }

    function attachEventHandlers() {
        // Handle edit product button click
        $('.edit-product').on('click', function() {
            let productId = $(this).data('id');

            $.ajax({
                url: `/api/products/${productId}`,
                type: 'GET',
                success: function(product) {
                    $('#editProductId').val(product.id);
                    $('#editName').val(product.name);
                    $('#editDescription').val(product.description);
                    $('#editPrice').val(product.price);
                    $('#editCategoryId').val(product.category_id);
                    $('#editSupplierId').val(product.supplier_id);
                    $('#editProductForm').attr('action', `/products/${productId}`);
                },
                error: function(xhr) {
                    console.error('Error fetching product data:', xhr);
                }
            });
        });

        // Handle delete product button click
        $('.delete-product').on('click', function() {
            let productId = $(this).data('id');
            let productName = $(this).data('name');

            $('#deleteProductId').val(productId);
            $('#productName').text(productName);
            $('#deleteProductForm').attr('action', `/products/${productId}`);
        });

        // Handle pagination clicks
        $('.pagination .page-link').on('click', function(e) {
            e.preventDefault();
            let page = $(this).data('page');
            let search = $('#searchInput').val();
            loadProducts(page, search);
        });
    }

    // Handle search
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        let search = $(this).val();

        searchTimeout = setTimeout(function() {
            loadProducts(1, search);
        }, 500);
    });

    $('#searchButton').on('click', function() {
        let search = $('#searchInput').val();
        loadProducts(1, search);
    });

    attachEventHandlers();
});
</script>
@endpush

@endsection