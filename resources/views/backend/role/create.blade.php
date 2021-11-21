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
        <div class="col-md-12">
            <div class="card border-info">
                <div class="card-header bg-success">
                    <h4 class="m-b-0 text-white">Create a new role</h4></div>
                <div class="card-body">
                    <div class="" data-toggle="buttons">
                        <form action="{{ route('role.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="col-sm-12 has-success">
                                    <input type="text" id="role" name="role" class="form-control form-control-lg" placeholder="Name of new role">
                                    @error('role')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @foreach($permissions as $permission)
                                <label class="btn btn-success active">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permission->name }}" id="permission-{{ $loop->iteration }}">
                                        <label class="custom-control-label" for="permission-{{ $loop->iteration }}">{{ $permission->name }}</label>
                                    </div>
                                </label>
                            @endforeach
                            @error('permissions')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="row button-group justify-content-between mt-5">
                                <div class="col-lg-2 col-md-4">
                                    <button type="button" class="btn waves-effect waves-light btn-block btn-info select-all">Select All</button>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <button type="submit" class="btn waves-effect waves-light btn-block btn-success">Save</button>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <button type="button" class="btn waves-effect waves-light btn-block btn-primary un-select-all">Unselect All</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



