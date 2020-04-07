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

                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Resi</label>

                            <input name="resi" type="text" class="form-control @if ($errors->has('resi')) is-invalid @endif" id="resi" value="{{ old('resi') ?? $order->resi }}" placeholder="Resi">

                            @if ($errors->has('resi'))
                                <div class="invalid-feedback">
                                    {{$errors->first('resi')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
        
                            <select name="status" class="custom-select @if ($errors->has('status')) is-invalid @endif" id="status">
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : null }}>Delivered</option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : null }}>Canceled</option>
                            </select>
        
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('status')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
