@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center pt-0 pt-md-3">
        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            @php
                $order = $order ?? null;
            @endphp
            
            @if ($order)
                <div class="card">
                    <div class="card-header">
                    Invoice {{ $order->invoice }}
                    </div>

                    <div class="card-body">
                        <div class="card-text">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Name </td>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Province</td>
                                        <td>{{ $order->province() }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $order->city() }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Street</td>
                                        <td>{{ $order->street }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Postcode</td>
                                        <td>{{ $order->postcode }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Resi</td>
                                        <td>{{ $order->resi ?? 'On Process' }}</td>
                                    </tr>
                
                                    <tr>
                                        <td>Status</td>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            @else
            <div class="pt-3">
                @include('partials._alerts')
            </div>

            <h5>Search your order</h5>
            
            <form action="{{ url('/order/detail') }}" method="get">
                <div class="form-group">
                    <label for="invoice">Invoice</label>

                    <input name="invoice" type="text" class="form-control @if ($errors->has('invoice')) is-invalid @endif" id="invoice" aria-describedby="invoice" value="{{ old('invoice') }}">

                    @if ($errors->has('invoice'))
                        <div class="invalid-feedback">
                            {{$errors->first('invoice')}}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-secondary d-block w-100">Search</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
