@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-12 col-lg-2 pt-3 pt-lg-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-12 col-lg-8 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Order
                        <form class="d-flex justify-content-between align-items-center" action="{{ route('admin.order.index') }}" method="get">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search Order" aria-label="Search Order" aria-describedby="button-search">
    
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" id="button-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Buyer</th>
                                    <th scope="col">Province</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach( $orders as $order )
                                @if ($order->status != 'canceled')
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{ $order->invoice }}</td>
                                    <td style="white-space: nowrap;">{{ $order->first_name . ' ' . $order->last_name }}</td>
                                    <td style="white-space: nowrap;">{{ $order->province() }}</td>
                                    <td>{{ $order->city() }}</td>
                                    <td>{{ $order->orderProducts()->sum('quantity') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <a href="{{ route( 'admin.order.edit', $order->id ) }}" class="btn btn-sm btn-primary rounded-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route( 'admin.order.show', $order->id ) }}" class="btn btn-sm btn-primary rounded-circle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-2 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">Print</div>
            
                <form action="{{ route('admin.order.print') }}" method="get">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date">Date</label>

                            <input type="text" name="date" id="date" class="form-control @if ($errors->has('date')) is-invalid @endif" value="{{ old('date') }}" placeholder="d/m/Y">

                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('date')}}
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" class="custom-select" id="status">
                                <option value="waited">Waited</option>
                                <option value="paid">Paid</option>
                                <option value="sended">Sended</option>
                                <option value="delivered">Delivered</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary d-block w-100">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
