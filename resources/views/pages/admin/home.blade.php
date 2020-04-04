@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row pt-0 pt-md-3">
        <div class="col-sm-12 col-md-4 pt-3 pt-md-0">
            <x-sidebar />
        </div>

        <div class="col-sm-12 col-md-8 pt-3 pt-md-0">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
