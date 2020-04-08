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

        <div class="col-sm-12 col-md-12 col-lg-10 pt-3 pt-lg-0">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Product
                        <form class="d-flex justify-content-between align-items-center" action="{{ route('admin.product.index') }}" method="get">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search Product" aria-label="Search Product" aria-describedby="button-search">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" id="button-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                            </div>
                            
                            <a href="{{ route('admin.product.create') }}" class="ml-2 btn btn-primary">Add</a>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="product-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
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
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.product.table') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'title', name: 'title'},
                {data: 'price', name: 'price'},
                {data: 'stock', name: 'stock'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [0, 2, 3, 4, 5], 
                    className: 'text-center align-middle no-wrap'
                },
                {
                    targets: [1], 
                    className: 'align-middle no-wrap'
                },
            ],
            bAutoWidth: false,
            drawCallback: function (settings) {
                $('#product-table').unwrap().wrap('<div class="table-responsive py-1"></div>');
            },
        });
    });
</script>
@endpush
@endsection
