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
                    <tr>
                        <th scope="row">1</th>
                        <td>Title</td>
                        <td>Rp 37,000</td>
                        <td>100</td>
                        <td>Rp 37,000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-4">
            <p class="font-weight-bolder">Thank you. Your order has been received.</p>
                        
            <ul class="list-unstyled">
                <li>Order number: 00001</li>
                <li>Date: 01/01/2001</li>
                <li>Payment method: BCA 0000-0000 a/n John Doe</li>
            </ul>

            <a href="#" class="btn btn-secondary d-block w-100">Payment confirmation</a>
        </div>
    </div>
</div>
@endsection
