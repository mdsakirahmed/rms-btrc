@extends('layouts.backend.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Blank Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
            </ol>
            <button type="button" class="btn btn-dark d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <form method="POST" action="{{ route('product.import') }}" class="input-form" enctype="multipart/form-data">
                    @csrf
                    <label class="control-label mt-3">@can('product import') For perfect import you are requested to <a href="{{ asset('sample/sample-products.xlsx') }}" download>download</a> the sample. or @endcan @can('product export')
                    <a href="{{ route('product.export') }}">Export All Data</a> @endcan </label>
                    @can('product import')
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="file" required>
                                <div class="input-group-append">
                                    <button class="btn btn-info text-white" type="submit">Import Now!</button>
                                </div>
                            </div>
                            @error('file')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table color-table success-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
