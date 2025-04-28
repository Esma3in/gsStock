@if ($customers->isNotEmpty())
    <ul>
        @foreach ($customers as $customer)
            <li>
                <strong>{{ $customer->first_name }} {{ $customer->last_name }}</strong>  
                ({{ $customer->orders->count() }} orders)
            </li>
        @endforeach
    </ul>
    <!-- Pagination links -->
@else
    <p>No customers found.</p>
@endif
