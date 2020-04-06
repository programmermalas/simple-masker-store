@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

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

    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-12 col-lg-4 pt-3 pt-lg-0">
            <div class="card" style="height: 80px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h5 class="card-title m-0">DELIVERY TO ALL INDONESIA</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4 pt-3 pt-lg-0">
            <div class="card" style="height: 80px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h5 class="card-title m-0">ALL ACTIVITIES MASKER</h5>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4 pt-3 pt-lg-0">
            <div class="card" style="height: 80px;">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h5 class="card-title m-0">CUSTOMER SERVICE</h5>
                </div>
            </div>
        </div>
    </div>

    <h4 class="pt-3">Product</h4>

    <div class="row pt-0 pt-md-3">
        @foreach ($products as $product)
        <div class="col-sm-12 col-md-6 col-lg-4 pt-3 pb-3 pt-md-0">
            <div class="card shadow-sm">
                <a href="{{ url("/product/{$product->slug}") }}" class="text-decoration-none text-reset">
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
                </a>

                <div class="card-footer">
                    <form action="{{ url("/product/{$product->slug}") }}" method="post">
                        @csrf
                        
                        <div class="row d-flex justify-content-between">
                            <div class="col-sm-12 col-md-6">
                                <input name="quantity" type="number" class="form-control" id="quantity" min="100" step="100" value="100">
                            </div>
    
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-secondary d-block w-100" style="white-space: nowrap;">Add to cart</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
