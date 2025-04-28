@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h2 class="display-4 mb-4">{{ trans('Welcome to Stock Management System') }}</h2>
    <p class="lead mb-4">Manage your inventory and customers efficiently</p>
    {{-- Avatar section --}}
    <div class="col-12">
        <div class="shadow-sm p-3">
            <form method="POST" action="{{ route('saveAvatar') }}"  enctype="multipart/form-data">
                @csrf
                <div style="border:solid" class="mb-3  w-50">
                    <label for="avatarFile" class="form-label">@lang('Choose your picture')</label>
                    <input  type="file" id="avatarFile" name="avatarFile" />
                </div>
                <button class="btn w-100 mb-3">
                    {{ __('Save picture') }} {{ trans("for your account") }}
                </button>
                @isset($name)
                    <div class="text-center">
                        <img style="width: 200px; border-radius: 50%;" src="{{ asset('storage/avatars/'.$pic) }}" alt="imaaaages">
                    </div>
                @endisset
            </form>
        </div>
    </div>
    <br><br><br><br><br>
    <ol style="background-color:grey">
        <li>        <a href="/customers" class="btn">List of Customers</a>        </li>
        <li>        <a href="/suppliers" class="btn ">List of Suppliers</a>        </li>
        <li>        <a href="{{ route('orders.index') }}" class="btn">Orders by Customer</a>        </li>
        <li>        <a href="/products" class="btn">List of Products</a>        </li>
        <li>        <a href="/products-by-store" class="btn">Products by Store</a>        </li>
        <li>        <a href="/products-by-supplier" class="btn">Products by Supplier</a>        </li>
        <li>        <a href="/products-by-category" class="btn">Products by Category</a>        </li>
    </ol>
    <br><br><br><br><br>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    {{-- Cookie section --}}
                            <h5>hello </h5>@if (Cookie::has('Username'))
                                <h1 class="text-primary">{{ Cookie::get('Username') }}</h1>
                            @endif
                            <form method="POST" action="saveCookie" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="txtCookie" class="form-label">Entrer votre nom:</label>
                                    <input style="border:solid"  type="text" id="txtCookie" name="txtCookie" />
                                </div>
                                <button style="border:solid"  >Save Cookie</button>
                            </form>

                    {{-- Session section --}}
                            <h5>hello</h5>@if (Session::has('SessionName'))
                                <h1 class="text-success">{{ Session("SessionName") }}</h1>
                            @endif
                            <form method="POST" action="saveSession" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="txtSession" class="form-label">Entrer votre nom:</label>
                                    <input style="border:solid" type="text" id="txtSession" name="txtSession" />
                                </div>
                                <button style="border:solid" >Save Session</button>
                            </form>
            </div>
        </div>
    </div>
</div>

@endsection
