@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-12 col-lg-2 pt-3 pt-lg-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-12 col-lg-10 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">
                    Payment
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="payment-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Date</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#payment-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.payment.table') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'invoice', name: 'invoice'},
                    {data: 'account_name', name: 'account_name'},
                    {data: 'account_number', name: 'account_number'},
                    {data: 'nominal', name: 'nominal'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                        targets: [0, 1, 4, 5, 6], 
                        className: 'text-center align-middle no-wrap'
                    },
                    {
                        targets: [2, 3, 4], 
                        className: 'align-middle no-wrap'
                    },
                ],
                bAutoWidth: false,
                drawCallback: function (settings) {
                    $('#payment-table').unwrap().wrap('<div class="table-responsive py-1"></div>');
                },
            });
        });
    </script>
@endpush
@endsection
