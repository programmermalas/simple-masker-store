@component('mail::message')
# Thank you. Your order has been received.

Invoice: {{ $order->invoice }} <br>
Bill: Rp {{ number_format( $order->bill->total, 0, '.', ',' ) }} <br>

Payment method: <br>
Bank Mandiri 136-00-1601-7664 a/n PT. Sahabat Unggul International

Order details <br>
@component('mail::table')
| # | Item | Quantity |
| :-: | :- | :-: |
@php
    $no = 0;    
@endphp
@foreach ($order->orderProducts as $product)
| {{ ++$no }} | {{ $product->product->title }} | {{$product->quantity}} |
@endforeach
@endcomponent

@component('mail::button', ['url' => url('/payment')])
Payment Confirmation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
