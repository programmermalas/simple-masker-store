@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row pt-0 pt-md-3" id="order">
        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <h5>Order details</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center">Invoice: {{ $order->invoice }}</th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($order->orderProducts as $orderProduct)
                    @if ($orderProduct->product)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>{{ $orderProduct->product->title }}</td>
                        <td>Rp {{ number_format( $orderProduct->product->price, 0, '.', ',' ) }}</td>
                        <td>{{ $orderProduct->quantity }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            
            <h5>Bill & Shipping</h5>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td>Quantity </td>
                        <td>{{ $order->orderProducts->sum('quantity') }}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>{{ $order->bill->weight / 1000 }} Kg</td>
                    </tr>
                    <tr>
                        <td>Courier</td>
                        <td>{{ $order->bill->courier ? ($order->bill->courier->name . ' ' . $order->bill->courier->service) : null }}</td>
                    </tr>
                    <tr>
                        <td>Shipping </td>
                        <td>Rp {{ number_format( $order->bill->shipping, 0, '.', ',' ) }}</td>
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
                        <td>Recipient's </td>
                        <td>{{ $order->recipients }}</td>
                    </tr>

                    <tr>
                        <td>Province</td>
                        <td>{{ $order->province->name }}</td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td>{{ $order->city->name }}</td>
                    </tr>

                    <tr>
                        <td>SubDistrict</td>
                        <td>{{ $order->subDistrict->name ?? null }}</td>
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
                        <td>Marketing</td>
                        <td>{{ $order->user->name ??  null }}</td>
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

    <div>
        <style>
            @media print {
                .no-print {
                    display: none !important;
                }
            }
        </style>
        <button class="btn btn-primary d-block w-100 no-print" id="print">Print</button>
    </div>
</div>

<script>
    $(function () {
        $('#print').click(function () {
            window.print();
        });
    });
</script>
@endsection
