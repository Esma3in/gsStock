@extends('layouts.app')
@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">List of customers</h2>
            </div>
            <div class="d-flex">
                <a href="{{ route('customers.create') }}" class="btn btn-success d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Add New Customer
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary d-flex align-items-center gap-2 ms-2">
                    <svg class="bi" width="16" height="16" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
            @if (session('success'))
                <div class='alert alert-sucess alert alert-dismissible fade show'>
                    <button type="button" class="btn-close" data-bs-dismiss='alert'></button>
                </div>

            @endif

            <div class="overflow-x-auto">
                <div class="mb-3">
                    <input type='text' id="customerSearch" placeholder="search for a customer" class="form-control" />
                </div>
                <table class="min-w-full divide-y divide-gray-200" id="customerTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                adress</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">phone
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>

                    <tbody id='customerTableBody'>
                    @foreach ($customers as $customer)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $customer->first_name }}
                                                {{ $customer->last_name}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $customer->email}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $customer->address}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $customer->phone }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a href="{{ route('customers.delete', $customer) }}" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                        class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                            </div>
                        </div>


                        @endforeach
                    </tbody>
                </table>
        <div class="pagination d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    <!-- Previous Page Link -->
                    @if ($customers->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $customers->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    <!-- Pagination Elements -->
                    @for ($i = 1; $i <= $customers->lastPage(); $i++)
                        <li class="page-item {{ ($customers->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $customers->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next Page Link -->
                    @if ($customers->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $customers->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    </div>
    </div>

    @push('script')
    <script>
        $(document).ready(function () {
            $('#customerSearch').on('keypress', function (e) {
                if (e.which === 13) {
                    var searchedTerm = $(this).val();
                    if (searchedTerm.length > 0) {
                        $.ajax({
                            url: "{{ route('customers.search') }}",
                            type: 'GET',
                            data: { term: searchedTerm },
                            success: function (response) {
                                var tableBody = $("#customerTableBody");
                                tableBody.empty();
                                var paginationContainer = $('.pagination');
                                paginationContainer.empty();
                                
                                if (response.customers.length > 0) {
                                    $.each(response.customers, function (index, customer) {
                                        var row = `
                                            <tr>
                                                <td>${customer.first_name} ${customer.last_name}</td>
                                                <td>${customer.email}</td>
                                                <td>${customer.address}</td>
                                                <td>${customer.phone}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="/customers/${customer.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="/customers/${customer.id}/delete" class="btn btn-sm btn-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>`;
                                        tableBody.append(row);
                                    });
                                    updatePagination(response.pagination);
                                } else {
                                    tableBody.append('<tr><td colspan="5" class="text-center">No results found</td></tr>');
                                }
                            },
                            error: function (xhr) {
                                console.error('Error fetching customers:', xhr);
                            }
                           
                        });
                    
                    }
                }
            });
        });
    </script>
@endpush
@endsection