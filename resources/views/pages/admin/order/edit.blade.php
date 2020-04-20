@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center pt-0 pt-md-3">
        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            @include('partials._alerts')

            <div class="card">
                <div class="card-header">
                    Edit Order ({{$order->invoice}})
                </div>

                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="firstName">First Name</label>
    
                                <input name="first_name" type="text" class="form-control @if ($errors->has('first_name')) is-invalid @endif" id="firstName" value="{{ old('first_name') ?? $order->first_name }}" placeholder="Resi">
    
                                @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('first_name')}}
                                    </div>
                                @endif
                            </div>
    
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="lastName">Last Name</label>
    
                                <input name="last_name" type="text" class="form-control @if ($errors->has('last_name')) is-invalid @endif" id="lastName" value="{{ old('last_name') ?? $order->last_name }}" placeholder="Resi">
    
                                @if ($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('last_name')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="resi">Resi</label>

                            <input name="resi" type="text" class="form-control @if ($errors->has('resi')) is-invalid @endif" id="resi" value="{{ old('resi') ?? $order->resi }}" placeholder="Resi">

                            @if ($errors->has('resi'))
                                <div class="invalid-feedback">
                                    {{$errors->first('resi')}}
                                </div>
                            @endif
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input name="courier" type="checkbox" class="custom-control-input" id="courier">
                            <label class="custom-control-label" for="courier">Without courier services</label>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
        
                            <select name="status" class="custom-select @if ($errors->has('status')) is-invalid @endif" id="status">
                                <option value="sended" {{ $order->status == 'sended' ? 'selected' : null }}>Sended</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : null }}>Delivered</option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : null }}>Canceled</option>
                            </select>
        
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('status')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="total">Total</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="total">Rp</span>
                                </div>

                                <input name="total" type="text" class="form-control @if ($errors->has('total')) is-invalid @endif" value="{{ $order->bill->total }}" aria-describedby="total">

                                @if ($errors->has('total'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('total')}}
                                    </div>
                                @endif
                            </div>
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
