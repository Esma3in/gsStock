@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="h3 mb-0">Orders by clients</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary d-flex align-items-center gap-2">
                <svg class="bi" width="16" height="16" fill="currentColor">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('order.bycustomers') }}">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer..." id="search_id" />
                        <button type="submit">Search</button>
                    </form>

                    <div id="loading" class="text-center d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <div id="customer-results"></div>
                    <div id="orders-container">

                    </div>

                     @push('scripts')
                    <script>
                        document.getElementById('search_id').addEventListener('input', function () {
                            const searchElement = this.value.trim();
                            const loader = document.getElementById('loading');
                            const customerResults = document.getElementById('customer-results');

                            customerResults.innerHTML = '';

                            if (searchElement) {
                                loader.classList.remove('d-none');

                                axios.get("{{ route('order.bycustomers') }}", {
                                    params: { search: searchElement }
                                })
                                .then(response => {
                                    loader.classList.add('d-none');
                                    customerResults.innerHTML = response.data; // Update search results
                                })
                                .catch(error => {
                                    loader.classList.add('d-none');
                                    customerResults.innerHTML = `<p class="text-danger">Error fetching data.</p>`;
                                });
                            }
                        });
                </script>
            @endpush
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
