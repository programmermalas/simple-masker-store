@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                            <label for="price">Price</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price">Rp</span>
                                </div>

                                <input name="price" type="text" class="form-control @if ($errors->has('price')) is-invalid @endif" value="{{ old('price') }}" placeholder="5.000" aria-label="5.000" aria-describedby="price">

                                @if ($errors->has('price'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('price')}}
                                    </div>
                                @endif
                            </div>
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