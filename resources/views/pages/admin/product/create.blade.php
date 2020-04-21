@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center pt-0 pt-md-3">
        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            @include('partials._alerts')

            <div class="card">
                <div class="card-header">
                    Add Product
                </div>

                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>

                            <input name="title" type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" id="title" value="{{ old('title') }}" placeholder="Masker">

                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{$errors->first('title')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="price_a">Price A</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price_a">Rp</span>
                                </div>

                                <input name="price_a" type="text" class="form-control @if ($errors->has('price_a')) is-invalid @endif" value="{{ old('price_a') }}" placeholder="5.000" aria-label="5.000" aria-describedby="price_a">

                                @if ($errors->has('price_a'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('price_a')}}
                                    </div>
                                @endif
                            </div>

                            <small id="priceAInline" class="text-muted">
                                Order > 50
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="price_b">Price B</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price_b">Rp</span>
                                </div>

                                <input name="price_b" type="text" class="form-control @if ($errors->has('price_b')) is-invalid @endif" value="{{ old('price_b') }}" placeholder="6.000" aria-label="5.000" aria-describedby="price_b">

                                @if ($errors->has('price_b'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('price_b')}}
                                    </div>
                                @endif
                            </div>

                            <small id="priceBInline" class="text-muted">
                                Order > 100
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="price_c">Price C</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price_c">Rp</span>
                                </div>

                                <input name="price_c" type="text" class="form-control @if ($errors->has('price_c')) is-invalid @endif" value="{{ old('price_c') }}" placeholder="7.000" aria-label="5.000" aria-describedby="price_c">

                                
                                @if ($errors->has('price_c'))
                                <div class="invalid-feedback">
                                    {{$errors->first('price_c')}}
                                </div>
                                @endif
                            </div>
                            
                            <small id="priceCInline" class="text-muted">
                                Order > 1000
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>

                            <input name="stock" type="number" class="form-control @if ($errors->has('stock')) is-invalid @endif" id="stock" value="{{ old('stock') }}" placeholder="0">

                            @if ($errors->has('stock'))
                                <div class="invalid-feedback">
                                    {{$errors->first('stock')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif" id="description" rows="3">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{$errors->first('description')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="weight">Gram</span>
                                </div>

                                <input name="weight" type="text" class="form-control @if ($errors->has('weight')) is-invalid @endif" value="{{ old('weight') }}" placeholder="5" aria-label="5" aria-describedby="weight">

                                @if ($errors->has('weight'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('weight')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input name="image" type="file" class="form-control-file @if ($errors->has('image')) is-invalid @endif" id="image">

                            @if ($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Store</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
