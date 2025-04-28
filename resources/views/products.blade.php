@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div>
            <form action="{{ route('search.route') }}" method="POST">
                @csrf
                <input type="text" name="search" placeholder="Search..." required>
                <button class="btn btn-info" type="submit">
                    <i class="fas fa-search"></i>search <!-- Requires Font Awesome -->
                </button>
            </form>
        </div>
            
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="card-title mb-0">Product List:{{count($products)}}</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Product
                </button>
                
                <button id="exportbtn" onclick="exportProducts()" type="button" class="btn btn-warning">
                    <i class="bi bi-plus-circle me-1"></i> export Products
                </button>
                <button id="" data-bs-toggle="modal" data-bs-target="#importProductModalLabel" type="button" class="btn btn-warning">
                    <i class="bi bi-plus-circle me-1"></i> import Products
                </button>
            </div>

            <div class="card-body">
                @if ($products && count($products) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->supplier->first_name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('partials.edit', ['product' => $product])
                                @include('partials.delete', ['product' => $product])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        No products found.
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('partials.add', ['categories' => $categories, 'suppliers' => $suppliers])
    @include('partials.import-excel')
    @if($errors->hasBag('add_product'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var addProductModal = new bootstrap.Modal(document.getElementById('addProductModal'));
                addProductModal.show();
            });
        </script>
    @endif

    @foreach ($products as $product)
        @if ($errors->hasBag("edit_product_".(string)$product->id))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var editProductModal = new bootstrap.Modal(document.getElementById('editProductModal{{ $product->id }}'));
                    editProductModal.show();
                });
            </script>
        @endif
    @endforeach
            <script>
                function exportProducts(){
                    window.location.href='/export'
                }
            </script>
            @if ($errors->has('file'))
                 <script>
                document.addEventListener('DOMContentLoaded', function() {
                var importProductModal = new bootstrap.Modal(document.getElementById('importProductModalLabel'));
                importProductModal.show();
                });
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
                </script>
            @endif
@endsection