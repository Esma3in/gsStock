@extends('layouts.app')

@section('content')


<div>
    <!-- Select dropdown to choose categories -->
    <select name="category" id="supplierSelect" class="form-control">
        <option value="">Select Category</option> <!-- Placeholder for category selection -->
        @foreach($suppliers as $supplier) <!-- Corrected variable name -->
        <option value="{{ $supplier->id }}">{{ $supplier->first_name }}</option>
        @endforeach
    </select>
</div>

<div id="productShow" class="mt-4">
    <!-- Display products here after selection -->
</div>

<script>
    const Select = document.getElementById('supplierSelect');
    const product_content = document.getElementById('productShow');

    Select.addEventListener('change', (e) => {
        product_content.innerHTML = '';
        const supplierId = e.target.value;
        console.log(supplierId)
        if (supplierId) {
            axios.get('/api/productBysupplier/' + supplierId)
                .then((response) => {
                    console.log(response)
                    if (response.data && response.data.products.length > 0) {
                        let tableHTML = `
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
    `;

                        // Loop through each product and add a row
                        response.data.products.forEach(product => {
                            tableHTML += `
            <tr>
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.category.name}</td>
                <td>${product.price}</td>
            </tr>
        `;
                        });

                        // Close the table structure
                        tableHTML += `</tbody></table>`;

                        // Insert the table HTML into the container
                        product_content.innerHTML = tableHTML;
                    } else {
                        product_content.innerHTML += `<p>this supplier dont have any products</p>`
                    }
                })
                .catch((error) => {
                    console.log(error.message)
                    product_content.innerHTML += `<p>error de feching data</p>`
                })
        }
    })
</script>

@endsection
