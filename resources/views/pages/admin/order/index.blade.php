@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <x-sidebar />
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Order
                        <form class="d-flex justify-content-between align-items-center" action="#">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Order" aria-label="Search Order" aria-describedby="button-search">
    
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" id="button-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
    
                            </div>
                            
                            <a href="#" class="ml-2 btn btn-primary">Add</a>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-primary rounded-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger rounded-circle">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
