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
                    <label for="recipientsName">Recipient's Name</label>

                    <input name="recipients_name" type="text" class="form-control @if ($errors->has('recipients_name')) is-invalid @endif" id="recipientsName" aria-describedby="recipientsName" value="{{ old('recipients_name') }}">

                    <small id="recipientsNameInline" class="text-muted">
                        If you want dropshipper *Optional
                    </small>

                    @if ($errors->has('recipients_name'))
                        <div class="invalid-feedback">
                            {{$errors->first('recipients_name')}}
                        </div>
                    @endif
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
                    <label for="subdistrict">SubDistrict</label>

                    <select name="subdistrict" class="custom-select @if ($errors->has('subdistrict')) is-invalid @endif" id="subdistrict">
                        <option>Select SubDistrict</option>
                    </select>

                    @if ($errors->has('subdistrict'))
                        <div class="invalid-feedback">
                            {{$errors->first('subdistrict')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="courier">Courier</label>
    
                        <select name="code_courier" class="custom-select @if ($errors->has('courier')) is-invalid @endif" id="courier">
                            <option value="">Select Courier</option>
                        </select>

                        <input type="hidden" name="name_courier">

                        @if ($errors->has('courier'))
                            <div class="invalid-feedback">
                                {{$errors->first('courier')}}
                            </div>
                        @endif
                    </div>
    
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="courier">Service</label>
    
                        <select name="price_service" class="custom-select @if ($errors->has('service')) is-invalid @endif" id="service">
                            <option value="">Select Service</option>
                        </select>

                        <input type="hidden" name="name_service">
    
                        @if ($errors->has('service'))
                            <div class="invalid-feedback">
                                {{$errors->first('service')}}
                            </div>
                        @endif
                    </div>
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
                            <td>
                                <span id="weight">{{ $weight / 1000 }}</span> Kg
                            </td>
                        </tr>

                        <tr>
                            <td>Shipping</td>
                            <td>Rp <span id="shipping">0</span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>Rp <span id="total">{{ \Cart::getTotal() }}</span></td>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" class="btn btn-primary d-block w-100">Pay</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(function () {
        $('select[name="city"]').prop('disabled', true);
        $('select[name="subdistrict"]').prop('disabled', true);
        $('select[name="code_courier"]').prop('disabled', true);
        $('select[name="price_service"]').prop('disabled', true);

        let total = $('#total').html();
        $('#total').html( new Intl.NumberFormat('ja-JP').format( total ) );

        $.get('/api/provinces', function ( data ) {
            $('select[name="province"]').empty().append( new Option( 'Select Province', null ) );

            $.map( data.rajaongkir.results, function ( value, index ) {
                $('select[name="province"]').append( new Option( value.province, value.province_id ) );
            });
        });

        $('select[name="province"]').change(function () {
            $('select[name="city"]').empty().append( new Option( 'Select City', null ) );
            $('select[name="subdistrict"]').empty().append( new Option( 'Select SubDistrict', null ) );
            $('select[name="code_courier"]').empty().append( new Option( 'Select Courier', null ) );
            $('select[name="price_service"]').empty().append( new Option( 'Select Service', null ) );

            $('select[name="city"]').prop('disabled', true);
            $('select[name="subdistrict"]').prop('disabled', true);
            $('select[name="code_courier"]').prop('disabled', true);
            $('select[name="price_service"]').prop('disabled', true);

            if ( $(this).val() !== 'null' ) {
                $.get('/api/province/' + $(this).val(), function ( data ) {
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
            $('select[name="subdistrict"]').empty().append( new Option( 'Select SubDistrict', null ) );
            $('select[name="code_courier"]').empty().append( new Option( 'Select Courier', null ) );
            $('select[name="price_service"]').empty().append( new Option( 'Select Service', null ) );

            $('select[name="subdistrict"]').prop('disabled', true);
            $('select[name="code_courier"]').prop('disabled', true);
            $('select[name="price_service"]').prop('disabled', true);

            if ( $(this).val() !== 'null' ) {
                $.get('/api/subdistrict/' + $(this).val(), function ( data ) {
                    if ( data.rajaongkir.results ) {
                        $('select[name="subdistrict"]').prop('disabled', false);

                        $.map( data.rajaongkir.results, function ( value, index ) {
                            $('select[name="subdistrict"]').append( new Option( value.subdistrict_name, value.subdistrict_id ) );
                        });
                    }
                });
            }
        });

        let subdistrict = null;

        $('select[name="subdistrict"]').change(function () {
            $('select[name="code_courier"]').prop('disabled', false).empty().append( 
                new Option( 'Select Courier', null ), 
                new Option( 'JNE', 'jne' ),
                new Option( 'JNT', 'jnt' ),
                new Option( 'TIKI', 'tiki' ),
                new Option( 'Lion Parcel', 'lion' ),
            );
            $('select[name="price_service"]').empty().append( new Option( 'Select Service', null ) );

            $('select[name="code_courier"]').prop('disabled', true);
            $('select[name="price_service"]').prop('disabled', true);

            if ( $(this).val() !== 'null' ) {
                $('select[name="code_courier"]').prop('disabled', false);

                subdistrict = $(this).val();
            }
        });

        $('select[name="code_courier"]').change(function () {
            $('select[name="price_service"]').empty().append( new Option( 'Select Service', null ) );

            $('select[name="price_service"]').prop('disabled', true);

            $('input[name="name_courier"]').val("");

            if ( $(this).val() !== 'null' ) {
                $('input[name="name_courier"]').val($('select[name="code_courier"] option:selected').text());

                $.get('/api/cost/' + subdistrict + '/' + (parseFloat($('#weight').html()) * 1000) + '/' + $(this).val(), function ( data ) {
                    if (data.rajaongkir.results) {
                        $('select[name="price_service"]').prop('disabled', false);
                        $.map( data.rajaongkir.results, function ( value, index ) {
                            $.map( value.costs, function ( value, index ) {
                                $('select[name="price_service"]').append( new Option( value.description + `(${value.service})`, value.cost[0].value ) );
                            } );
                        });
                    }
                });
            }
        });
        
        $('select[name="price_service"]').change(function () {
            let shipping = null;
            let totals = null;

            if ( $(this).val() === 'null' ) {
                shipping = 0;
                totals = 0;

                $('input[name="name_service"]').val("");
            }

            $('input[name="name_service"]').val($('select[name="price_service"] option:selected').text());
            shipping = $(this).val();
            totals = parseInt( total ) + parseInt( shipping );

            $('#shipping').html( new Intl.NumberFormat('ja-JP').format( shipping ) );
            $('#total').html( new Intl.NumberFormat('ja-JP').format( totals ) );
        });
    });
</script>
@endpush
@endsection
