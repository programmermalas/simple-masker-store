<!DOCTYPE html>
<html>
    <head>
        <title>Order {{ $date ? $date->format('d/m/Y') : 'All Date' }}</title>
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
        <h3 class="title">Order {{ $date ? $date->format('d/m/Y') : 'All Date' }}</h3>
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
                        <td>{{ $data->province_id }}</td>
                        <td>{{ $data->city_id }}</td>
                        <td>{{ $data->street }}</td>
                        <td style="text-align: center;">{{ $data->orderProducts->sum('quantity') }}</td>
                        <td style="text-align: center;">{{ $data->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>