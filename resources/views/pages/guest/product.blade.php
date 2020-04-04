@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

    <div class="row pt-3">
        <div class="col-6">
            <div class="d-flex justify-content-center align-items-center shadow-sm" style="height: 480px; overflow: hidden;">
                <img src="/storage/images/500/{{ $product->productImage->name }}" class="d-block w-100" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $product->productImage->name }}">
            </div>
        </div>

        <div class="col-6">
            <form action="{{ url("/product/{$product->slug}") }}" method="post">
                @csrf

                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-light"><h5>{{ $product->title }}</h5></li>

                    <li class="list-group-item bg-light">
                        <p>{{ $product->description }}</p>    
                    </li>

                    <li class="list-group-item bg-light">Stock: {{ $product->stock }}</li>
                    
                    <li class="list-group-item bg-light">Weight: {{ $product->weight }} Gram</li>

                    <li class="list-group-item bg-light">Rp {{ number_format( $product->price, 0, '.', ',' ) }}</li>
                    
                    <li class="list-group-item bg-light">
                        <div class="form-group mb-0 row">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>

                            <div class="col-sm-10">
                                <input name="quantity" type="number" class="form-control @if ($errors->has('title')) is-invalid @endif" id="quantity" min="100" step="100" value="{{ old('title') ?? '100' }}">

                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('title')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-light">
                        <button type="submit" class="btn btn-secondary d-block w-100">Add to cart</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
@endsection
