@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <h5>Order details</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($order->orderProducts as $orderProduct)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>{{ $orderProduct->product->title }}</td>
                        <td>Rp {{ number_format( $orderProduct->product->price, 0, '.', ',' ) }}</td>
                        <td>{{ $orderProduct->quantity }}</td>
                        <td>{{ number_format( $orderProduct->quantity * $orderProduct->product->price, 0, '.', ',' ) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <h5>Bill & Shipping</h5>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td>Shipping </td>
                        <td>Rp {{ number_format( $order->bill->shipping, 0, '.', ',' ) }}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>{{ number_format( $order->bill->weight, 0, '.', ',' ) }} Gram</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Rp {{ number_format( $order->bill->total, 0, '.', ',' ) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <h5>Buyer details</h5>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td>Invoice </td>
                        <td>{{ $order->invoice }}</td>
                    </tr>

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
@endsection
