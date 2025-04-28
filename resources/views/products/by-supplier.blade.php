@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0">Products by Supplier</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <svg class="bi" width="16" height="16" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Select dynamique des listes des suppliers -->
    <select id="select-form" name="select-form" class="form-select">
        <option>Selectionner un supplier :</option>
        @foreach($suppliers as $supplier)
            <option value={{$supplier->id}}>{{ $supplier->first_name }} {{ $supplier->last_name }}</option>
        @endforeach
    </select>

    <div id="loading" class="text-center d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="products-container">
    </div>
</div>
@push('scripts')
<script>
    document.getElementById('select-form').addEventListener('change', function() {
        const supplierId = this.value;

        const loadingElement = document.getElementById('loading');
        const productsContainer = document.getElementById('products-container');
        productsContainer.innerHTML = '';
        if (supplierId) {
            loadingElement.classList.remove('d-none');
            axios.get(`/api/products-by-supplier/${supplierId}`)
                .then(response => {
                    productsContainer.innerHTML = response.data;
                
                })
                .catch(error => {
                    console.error('Error:', error);
                })
                .finally(() => {
                    loadingElement.classList.add('d-none');
                });
        }
    });
</script>
@endpush
@endsection
