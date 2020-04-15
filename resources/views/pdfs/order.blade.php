<!DOCTYPE html>
<html>
    <head>
        <title>Order {{ $date ? $date->format('d/m/Y') : 'All Date' }}</title>
    </head>

    <style>
        @page {
            margin-top: 0px;
        }
        .table {
            font-size: .6rem;
            width: 100%;
        }

        .table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .title {
            text-align: center;
        }
    </style>

    <body>
        <h3 class="title">Order {{ $date ? $date->format('d/m/Y') : 'All Date' }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-alignt: center">Invoice</th>
                    <th style="text-align: left;">Buyer</th>
                    <th style="text-align: left;">Province</th>
                    <th style="text-align: left;">City</th>
                    <th style="text-align: left;">Street</th>
                    <th>Status</th>
                    <th>Marketing</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                    $total = 0;
                    $quantity = 0;
                @endphp
                @foreach ($datas as $data)
                    <tr>
                        <td style="text-align: center;">{{ ++$no }}</td>
                        <td style="text-align: center;">{{ $data->invoice }}</td>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->province->name }}</td>
                        <td>{{ $data->city->name }}</td>
                        <td>{{ $data->street }}</td>
                        <td style="text-align: center;">{{ $data->status }}</td>
                        <td style="text-align: center;">{{ $data->user->name ?? null }}</td>
                        <td style="text-align: center;">
                            @php
                                $quantity += $data->orderProducts->sum('quantity');
                            @endphp
                            {{ $data->orderProducts->sum('quantity') }}
                        </td>
                        <td style="text-align: right;">
                            @php
                                if ( $data->bill ) {
                                    $total += $data->bill->total;
                                }
                            @endphp
                            {{ number_format( $data->bill->total ?? 0 , 0, '.', ',' ) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" style="text-align: center;">Total</td>
                    <td style="text-align: center;">{{ $quantity }}</td>
                    <td style="text-align: center;">{{ number_format( $total, 0, '.', ',' ) }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>