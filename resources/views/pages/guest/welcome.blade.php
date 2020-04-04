@extends('layouts.guest')

@section('content')
<div class="container">
    <div id="carouselExampleControls" class="carousel slide pt-3" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/728x140.png?text=Image+1" class="d-block w-100" alt="Image 1">
            </div>

            <div class="carousel-item">
                <img src="https://via.placeholder.com/728x140.png?text=Image+2" class="d-block w-100" alt="Image 2">
            </div>

            <div class="carousel-item">
                <img src="https://via.placeholder.com/728x140.png?text=Image+3" class="d-block w-100" alt="Image 3">
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row pt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Easy Payment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Easy Return & Exchange</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Limited Lifetime Waranty</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="pt-3">Product</h4>

    <div class="row pt-3">
        @foreach ($products as $product)
        <div class="col-4">
            <a href="{{ url("/product/{$product->slug}") }}" class="text-decoration-none text-reset">
                <div class="card shadow-sm">
                    <div class="py-3">
                        <div class="d-flex justify-content-center align-items-center" style="height: 240px; overflow: hidden;">
                            <img src="{!! asset( 'storage/images/300/' . $product->productImage->name ) !!}" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $product->productImage->name }}">
                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="card-title">{{ $product->title }}</h6>

                        <div class="card-text">
                            <span>Rp {{ number_format( $product->price, 0, '.', ',' ) }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
