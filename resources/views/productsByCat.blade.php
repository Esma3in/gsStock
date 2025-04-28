@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0">Products by Category</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Select Category:</label>
                        <select name="category" id="categorySelect" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="productShow" class="mt-4">
                        <p>Please select a category to view products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const select = document.getElementById('categorySelect');
    const product_section = document.getElementById('productShow');

    select.addEventListener('change', (e) => {
        product_section.innerHTML = '';

        const categoryId = e.target.value;
        console.log('Selected Category ID:', categoryId);

        if (categoryId) {
            axios.get('/api/productsByCat/' + categoryId)
                .then(response => {
                    console.log('Response HTML:', response.data);
                    product_section.innerHTML = response.data;
                })
                .catch(error => {
                    console.log(error.message);
                    product_section.innerHTML = '<div class="alert alert-danger" role="alert">There was an error fetching products.</div>';
                });
        } else {
            product_section.innerHTML = '<p>Please select a category to view products.</p>';
        }
    });
</script>
@endsection