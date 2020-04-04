@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <div class="d-flex justify-content-center align-items-center shadow-sm" style="height: 480px; overflow: hidden;">
                <img src="/storage/images/500/{{ $product->productImage->name }}" class="d-block w-100" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $product->productImage->name }}">
            </div>
        </div>

        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light"><h5>{{ $product->title }}</h5></li>
                <li class="list-group-item bg-light">
                    <p>{{ $product->description }}</p>    
                </li>
                <li class="list-group-item bg-light">Stock: {{ $product->stock }}</li>
                <li class="list-group-item bg-light">Weight: {{ $product->weight }} Gram</li>
                <li class="list-group-item bg-light">Price: Rp {{ number_format( $product->price, 0, '.', ',' ) }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
