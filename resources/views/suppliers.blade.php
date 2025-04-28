@extends('layouts.app')

@section('content')

<div class="container mt-5">
    @if (count($suppliers) > 0)
        <div class="row">
            @foreach ($suppliers as $supplier)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $supplier->first_name }} {{ $supplier->last_name }}
                            </h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Email:</strong> {{ $supplier->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong> {{ $supplier->phone }}
                                </li>
                                </li class="list-group-item">
                                    <strong>Address:</strong> {{ $supplier->address }}
                                </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            No suppliers found.
        </div>
    @endif
</div>
@endsection