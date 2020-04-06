@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-4 pt-3 pt-md-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Payment
                        <form class="d-flex justify-content-between align-items-center" action="#">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Payment" aria-label="Search Payment" aria-describedby="button-search">
    
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Nominal</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach( $payments as $payment )
                                <tr>
                                    <th scope="row">{{ ++$no }}</th>
                                    <td>{{ $payment->order->invoice }}</td>
                                    <td style="white-space: nowrap;">{{ $payment->account_name }}</td>
                                    <td style="white-space: nowrap;">{{ $payment->account_number }}</td>
                                    <td>{{ number_format( $payment->nominal, 0, '.', ',' ) }}</td>
                                    <td class="text-center" style="white-space: nowrap;">
                                        <a href="{{ route( 'admin.payment.edit', $payment->id ) }}" class="btn btn-sm btn-secondary rounded-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
