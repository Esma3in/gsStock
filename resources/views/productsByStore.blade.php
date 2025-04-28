@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="card-title mb-0">Products by Store</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="storeSelect" class="form-label">Select Store:</label>
                        <select name="store" id="storeSelect" class="form-select">
                            <option value="">Select Store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="productShow" class="mt-4">
                        <p>Please select a store to view products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const select = document.getElementById('storeSelect');
    const product_section = document.getElementById('productShow');

    select.addEventListener('change', (e) => {
        product_section.innerHTML = '';

        const storeId = e.target.value;
        console.log('Selected Store ID:', storeId);

        if (storeId) {
            axios.get('/api/getProductBystore/' + storeId)
                .then(response => {
                    const products = response.data;
                    let html = `<table class="table table-bordered table-striped">
                                  <thead class="table-light">
                                    <tr>
                                      <th>Name</th>
                                      <th>Category</th>
                                      <th>Description</th>
                                      <th>Quantity</th>
                                      <th>Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>`;

                    products.forEach(product => {
                        html += `<tr>
                                   <td>${product.name}</td>
                                   <td>${product.category.name}</td>
                                   <td>${product.description}</td>
                                   <td>${product.stock.quantity_stock}</td>
                                   <td>${product.price} MAD</td>
                                 </tr>`;
                    });

                    html += `</tbody></table>`;
                    product_section.innerHTML = html;
                    console.log('Response HTML:', response.data);
                })
                .catch(error => {
                    console.log(error.message);
                    product_section.innerHTML = '<div class="alert alert-danger" role="alert">There was an error fetching products.</div>';
                });
        } else {
            product_section.innerHTML = '<p>Please select a store to view products.</p>';
        }
    });
</script>
@endsection