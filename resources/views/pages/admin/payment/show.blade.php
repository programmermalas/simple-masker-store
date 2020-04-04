@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-6">
            <div class="d-flex justify-content-center align-items-center shadow-sm" style="height: 480px; overflow: hidden;">
                <img src="/storage/invoices/500/{{ $payment->paymentImage->name }}" class="d-block w-100" style="background-size: cover; background-repeat: no-repeat;" alt="{{ $payment->paymentImage->name }}">
            </div>
        </div>

        <div class="col-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-light">Invoice: {{ $payment->order->invoice }}</li>

                <li class="list-group-item bg-light">Name: {{ $payment->acccount_name }}</li>

                <li class="list-group-item bg-light">Number: {{ $payment->account_number }}</li>
                
                <li class="list-group-item bg-light">Nominal: Rp {{ number_format( $payment->nominal, 0, '.', ',' ) }}</li>

                <li class="list-group-item bg-light">Note: {{ $payment->note }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
