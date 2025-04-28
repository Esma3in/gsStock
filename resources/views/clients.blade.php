@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-success" onclick="window.location.href='/customer/Add'">
            Add New Customer
        </button>
        <div id="customer-count" class="text-muted">
          Total Customers: {{ count($customers) }}
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class=" table table-responsive">
        <tr>
            <th>name</th>
            <th>email</th>
            <th>phone number</th>
            <th>adresse</th>
            <th>actions</th>
        </tr>
        <tbody>
             @if (count($customers) > 0)
        @foreach ($customers as $customer)
            <tr>
                <td>{{$customer->first_name}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->address}}</td>
                <td><div class="d-flex justify-content-between mt-3">
                    <a href="/customer/edit/{{ $customer->id }}" class="btn btn-sm btn-info">Edit</a>
                    <a href="/customer/delete/{{ $customer->id }}" class="btn btn-sm btn-danger">Delete</a>
                </div></td>
            </tr>
        @endforeach
    @else
        <div class="alert alert-info" role="alert">
            No customers found.
        </div>
    @endif
        </tbody>
    </table>
    <div class="paginate">
        {{$customers->links()}}
    </div>

   
</div>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>

@endsection