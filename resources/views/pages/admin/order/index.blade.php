@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-4 pt-3 pt-md-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Order
                        <form class="d-flex justify-content-between align-items-center" action="{{ route('admin.order.index') }}" method="get">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search Order" aria-label="Search Order" aria-describedby="button-search">
    
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-search">
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
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{ $order->invoice }}</td>
                                    <td style="white-space: nowrap;">{{ $order->first_name . ' ' . $order->last_name }}</td>
                                    <td style="white-space: nowrap;">{{ $order->province() }}</td>
                                    <td>{{ $order->city() }}</td>
                                    <td>{{ $order->orderProducts()->sum('quantity') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <a href="{{ route( 'admin.order.edit', $order->id ) }}" class="btn btn-sm btn-secondary rounded-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route( 'admin.order.show', $order->id ) }}" class="btn btn-sm btn-secondary rounded-circle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
