@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="d-flex justify-content-center align-items-center shadow-sm" style="height: 480px; overflow: hidden;">
                <img src="/storage/images/500/{{ $product->productImage->name }}" class="d-block w-100" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $product->productImage->name }}">
            </div>
        </div>

        <div class="col-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light"><h5>{{ $product->title }}</h5></li>
                <li class="list-group-item bg-light">
                    <p>{{ $product->description }}</p>    
                </li>
                <li class="list-group-item bg-light">Stock: {{ $product->stock }}</li>
                <li class="list-group-item bg-light">Rp {{ number_format( $product->price, 0, '.', ',' ) }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
