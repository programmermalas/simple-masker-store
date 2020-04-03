@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-8">
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
        </div>

        <div class="col-4">
            <p class="font-weight-bolder">Thank you. Your order has been received.</p>
                        
            <ul class="list-unstyled">
                <li>Order number: {{ $order->invoice }}</li>
                <li>Date: {{ $order->created_at->format('d/m/Y') }}</li>
                <li>Payment method: Bank Mandiri 136-00-1601-7664 a/n PT. Sahabat Unggul International</li>
            </ul>

            <a href="{{ url("/payment-confirmation") }}" class="btn btn-secondary d-block w-100">Payment confirmation</a>
        </div>
    </div>
</div>
@endsection
