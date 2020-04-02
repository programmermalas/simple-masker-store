@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-8">
            <h5>Billing & shipping</h5>
            <form action="#" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" aria-describedby="firstName">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" aria-describedby="lastName">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="province">Province</label>
                    <select class="custom-select" id="province">
                        <option>Select Province</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="city">City</label>
                    <select class="custom-select" id="city">
                        <option>Select City</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <select class="custom-select" id="district">
                        <option>Select District</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="street">Street Address</label>
                    <input type="text" class="form-control" id="street" aria-describedby="street">
                </div>

                <div class="form-group">
                    <label for="postcode">Postcode / ZIP</label>
                    <input type="text" class="form-control" id="postcode" aria-describedby="postcode">
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" aria-describedby="phone">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" aria-describedby="email">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Totals</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>Rp 37,000</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Rp 5,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td>Rp 42,000</td>
                    </tr>
                </tfoot>
            </table>

            <button type="submit" class="btn btn-secondary d-block w-100">Pay</button>
        </div>
    </div>
</div>
@endsection
