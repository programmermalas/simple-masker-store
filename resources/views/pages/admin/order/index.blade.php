@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="pt-3">
        @include('partials._alerts')
    </div>

    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-12 col-lg-2 pt-3 pt-lg-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-12 col-lg-8 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">
                    Order
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="order-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Buyer</th>
                                <th scope="col">Province</th>
                                <th scope="col">City</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-2 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">Filter</div>
            
                <form id="filter">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date">Date</label>

                            <input type="text" name="dateFilter" id="date" class="form-control" placeholder="DD/MM/YYYY">
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="statusFilter" class="custom-select" id="status">
                                <option value="">Select Status</option>
                                <option value="waited">Waited</option>
                                <option value="payment_confirmation">Payment Confirmation</option>
                                <option value="paid">Paid</option>
                                <option value="sended">Sended</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary d-block w-100">Filter</button>
                    </div>
                </form>
            </div>

            <div class="card mt-3">
                <div class="card-header">Print</div>
            
                <form id="print" action="{{ route('admin.order.print') }}" method="get">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date">Date</label>

                            <input type="text" name="date" id="date" class="form-control @if ($errors->has('date')) is-invalid @endif" value="{{ old('date') }}" placeholder="DD/MM/YYYY">

                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('date')}}
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>

                            <select name="status" class="custom-select" id="status">
                                <option value="">Select Status</option>
                                <option value="waited">Waited</option>
                                <option value="paid">Paid</option>
                                <option value="sended">Sended</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary d-block w-100">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        orderTable();

        function orderTable(date = null, status = null) {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.order.table') }}",
                    data: {
                        date: date,
                        status: status
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'invoice', name: 'invoice'},
                    {data: 'buyer', name: 'buyer'},
                    {data: 'province', name: 'province'},
                    {data: 'city', name: 'city'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'status', name: 'status'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                        targets: [0, 5, 6, 7, 8], 
                        className: 'text-center align-middle no-wrap'
                    },
                    {
                        targets: [1, 2, 3, 4], 
                        className: 'align-middle no-wrap'
                    },
                ],
                bAutoWidth: false,
                drawCallback: function (settings) {
                    $('#order-table').unwrap().wrap('<div class="table-responsive py-1"></div>');
                },
            });
        }

        $('#filter').submit(function (event) {
            event.preventDefault()
        })
        .validate({
            rules: {
                dateFilter: { dateFormat: true },
            },
            submitHandler: function (form) {
                let date = $('input[name="dateFilter"]').val()
                let status = $('select[name="statusFilter"]').val()

                $('#order-table').DataTable().destroy()
                orderTable( date, status );
            }
        });

        $('#print').validate({
            rules: {
                date: { dateFormat: true },
            }
        });
    });
</script>
@endpush
@endsection
