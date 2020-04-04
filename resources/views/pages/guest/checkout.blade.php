@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

    <form action="{{ url('/order') }}" method="post" id="order">
        @csrf

        <div class="row pt-0 pt-md-3">
            <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
                <h5>Billing & shipping</h5>

                <div class="row">
                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="firstName">First Name</label>

                            <input name="first_name" type="text" class="form-control @if ($errors->has('first_name')) is-invalid @endif" id="firstName" aria-describedby="firstName" value="{{ old('first_name') }}">

                            @if ($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('first_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="lastName">Last Name</label>

                            <input name="last_name" type="text" class="form-control @if ($errors->has('last_name')) is-invalid @endif" id="lastName" aria-describedby="lastName" value="{{ old('last_name') }}">

                            @if ($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('last_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="province">Province</label>

                    <select name="province" class="custom-select @if ($errors->has('province')) is-invalid @endif" id="province">
                        <option>Select Province</option>
                    </select>

                    @if ($errors->has('province'))
                        <div class="invalid-feedback">
                            {{$errors->first('province')}}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="city">City</label>

                    <select name="city" class="custom-select @if ($errors->has('city')) is-invalid @endif" id="city">
                        <option>Select City</option>
                    </select>

                    @if ($errors->has('city'))
                        <div class="invalid-feedback">
                            {{$errors->first('city')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="street">Street Address</label>

                    <input name="street" type="text" class="form-control @if ($errors->has('street')) is-invalid @endif" id="street" aria-describedby="street" value="{{ old('street') }}">

                    @if ($errors->has('street'))
                        <div class="invalid-feedback">
                            {{$errors->first('street')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="postcode">Postcode / ZIP</label>

                    <input name="postcode" type="text" class="form-control @if ($errors->has('postcode')) is-invalid @endif" id="postcode" aria-describedby="postcode" value="{{ old('postcode') }}">

                    @if ($errors->has('postcode'))
                        <div class="invalid-feedback">
                            {{$errors->first('postcode')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="phone">Phone</label>

                            <input name="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" id="phone" aria-describedby="phone" value="{{ old('phone') }}">

                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{$errors->first('phone')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="email">Email</label>

                            <input name="email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" id="email" aria-describedby="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 pt-3 pt-md-0">
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
                            <td>Rp {{ number_format( \Cart::getSubTotal(), 0, '.', ',' ) }}</td>
                        </tr>

                        <tr>
                            <td>Weight</td>
                            <td><input type="hidden" name="weight" value="{{ $weight }}"><span id="weight">{{ $weight }}</span> Gram</td>
                        </tr>

                        <tr>
                            <td>Shipping</td>
                            <td>Rp <input type="hidden" name="shipping"><span id="shipping"></span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>Rp <input type="hidden" name="total"><span id="total">{{ \Cart::getTotal() }}</span></td>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" class="btn btn-secondary d-block w-100">Pay</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('select[name="city"]').prop('disabled', true);
    $('#shipping').html(0);
    let total = $('#total').html();
    $('input[name="total"]').val( total );
    $('#total').html( new Intl.NumberFormat('ja-JP').format( total ) );

    let provinces = [];

    $.get('/api/provinces', function ( data ) {
        $('select[name="province"]').empty().append( new Option( 'Select Province', null ) );

        $.map( data.rajaongkir.results, function ( value, index ) {
            $('select[name="province"]').append( new Option( value.province, value.province_id ) );
        });
    });

    $('select[name="province"]').change(function () {
        $('select[name="city"]').empty().append( new Option( 'Select City', null ) );

        if ( $(this).val() !== null ) {
            $.get('/api/provinces/' + $(this).val(), function ( data ) {
                $('select[name="city"]').prop('disabled', true);

                if ( data.rajaongkir.results ) {
                    $('select[name="city"]').prop('disabled', false);

                    $.map( data.rajaongkir.results, function ( value, index ) {
                        $('select[name="city"]').append( new Option( value.type + ' ' + value.city_name, value.city_id ) );
                    });
                }
            });
        }
    });

    $('select[name="city"]').change(function () {
        $.get('/api/cost/' + $(this).val() + '/' + $('#weight').html(), function ( data ) {
            $('#shipping').html(0);

            if (data.rajaongkir.results) {
                let shipping = data.rajaongkir.results[0].costs[1].cost[0].value;
                let totals = parseInt( total ) + data.rajaongkir.results[0].costs[1].cost[0].value;

                $('#shipping').html( new Intl.NumberFormat('ja-JP').format( shipping ) );
                $('input[name="shipping"]').val( shipping );
                $('#total').html( new Intl.NumberFormat('ja-JP').format( totals ) );
                $('input[name="total"]').val( totals );
            }
        });
    });
</script>
@endsection
