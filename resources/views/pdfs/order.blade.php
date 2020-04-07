<!DOCTYPE html>
<html>
    <head>
        <title>Order {{ $date->format('d/m/Y') }}</title>
    </head>

    <style>
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
        <h3 class="title">Order tanggal {{ $date->format('d/m/Y') }}</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align: left;">Buyer</th>
                    <th style="text-align: left;">Province</th>
                    <th style="text-align: left;">City</th>
                    <th style="text-align: left;">Street</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($datas as $data)
                    <tr>
                        <td style="text-align: center;">{{ ++$no }}</td>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->province() }}</td>
                        <td>{{ $data->city() }}</td>
                        <td>{{ $data->street }}</td>
                        <td style="text-align: center;">{{ $data->orderProducts->sum('quantity') }}</td>
                        <td style="text-align: center;">{{ $data->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>