@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="pt-3">
        @include('partials._alerts')
    </div>
    
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <div class="d-flex justify-content-center align-items-center shadow-sm" style="height: 480px; overflow: hidden;">
                <img src="/storage/invoices/500/{{ $payment->paymentImage->name }}" class="d-block w-100" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $payment->paymentImage->name }}">
            </div>
        </div>

        <div class="col-sm-12 col-md-6 pt-3 pt-md-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light">Invoice: {{ $payment->order->invoice }}</li>

                <li class="list-group-item bg-light">Name: {{ $payment->account_name }}</li>

                <li class="list-group-item bg-light">Number: {{ $payment->account_number }}</li>
                
                <li class="list-group-item bg-light">Nominal: Rp {{ number_format( $payment->nominal, 0, '.', ',' ) }}</li>

                <li class="list-group-item bg-light">Note: {{ $payment->note }}</li>

                <li class="list-group-item bg-light">
                    <form action="{{ route( 'admin.payment.update', $payment->id ) }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="id" value="{{ $payment->order_id }}">

                        <button type="submit" class="btn btn-secondary w-100 d-block">Received</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
