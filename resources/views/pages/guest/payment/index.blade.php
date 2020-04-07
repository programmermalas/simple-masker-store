@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center pt-0 pt-md-3">
        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            <div class="pt-3">
                @include('partials._alerts')
            </div>

            <h5>Payment Confirmation</h5>
            
            <form action="{{ url('/payment') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="invoice">Invoice</label>

                    <input name="invoice" type="text" class="form-control" id="invoice" aria-describedby="invoice" value="{{ old('invoice') }}">
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="accountName">Account Name</label>

                            <input name="account_name" type="text" class="form-control @if ($errors->has('account_name')) is-invalid @endif" id="accountName" aria-describedby="accountName" value="{{ old('account_name') }}">

                            @if ($errors->has('account_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('account_name')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
                        <div class="form-group">
                            <label for="accountNumber">Account Number</label>

                            <input name="account_number" type="text" class="form-control @if ($errors->has('account_number')) is-invalid @endif" id="accountNumber" aria-describedby="accountNumber" value="{{ old('account_number') }}">

                            @if ($errors->has('account_number'))
                                <div class="invalid-feedback">
                                    {{$errors->first('account_number')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nominal">Nominal</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="nominal">Rp</span>
                        </div>

                        <input name="nominal" type="text" class="form-control @if ($errors->has('nominal')) is-invalid @endif" value="{{ old('nominal') }}" aria-label="5" aria-describedby="nominal">

                        @if ($errors->has('nominal'))
                            <div class="invalid-feedback">
                                {{$errors->first('nominal')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="note">Note</label>

                    <input name="note" type="text" class="form-control @if ($errors->has('note')) is-invalid @endif" id="note" aria-describedby="note" value="{{ old('note') }}">

                    @if ($errors->has('note'))
                        <div class="invalid-feedback">
                            {{$errors->first('note')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input name="image" type="file" class="form-control-file @if ($errors->has('image')) is-invalid @endif" id="image">

                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{$errors->first('image')}}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary d-block w-100">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
