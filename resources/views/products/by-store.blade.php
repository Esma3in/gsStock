@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0">Products by Store</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <svg class="bi" width="16" height="16" fill="currentColor">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <select id="select_store" class= "form-select">
                <option value="">Select a Store</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="loading" class="d-none">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div id="productsContainer">

        </div>
        @push('scripts')
        <script>
            document.getElementById('select_store').addEventListener('change', function() {
                const storeId = this.value;
                const loadingEle = document.getElementById('loading');
                const productsContainer = document.getElementById('productsContainer');
        
                productsContainer.innerHTML = '';
        
                if (storeId) {
                    loadingEle.classList.remove('d-none');
        
                    axios.get(`/api/products-by-store/${storeId}`)
                        .then(response => {
                            const productsList = response.data;
                            let view = '<div class="table-responsive"><table class="table tabler"><thead><tr><th>Name</th><th>Category</th><th>Description</th><th>Price</th><th>Stock</th></tr></thead><tbody>';
        
                            if (productsList.length > 0) {
                                productsList.forEach(product => {
                                    view += `<tr>
                                        <td>${product.name}</td>
                                        <td>${product.category.name}</td>
                                        <td>${product.description}</td>
                                        <td>${parseFloat(product.price).toFixed(2)}</td>
                                        <td>${product.stock ? product.stock.quantity : 0}</td>
                                    </tr>`;
                                });
                            } else {
                                view += '<tr><td colspan="5">No products existent dans ce store</td></tr>';
                            }
        
                            view += '</tbody></table></div>';
                            productsContainer.innerHTML = view;
                        })
                        .catch(error => console.log(error))
                        .finally(() => {
                            loadingEle.classList.add('d-none');
                        });
                } else {
                    productsContainer.innerHTML = '<p class="text-muted">Aucun store sélectionné</p>';
                }
            });
        </script>
        @endpush


@endsection
