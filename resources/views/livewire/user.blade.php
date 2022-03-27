<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">User Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">User Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" data-bs-toggle="modal" data-bs-target="#user-modal" wire:click="create"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table success-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles()->first()->name ?? '_' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user-modal" wire:click="selectForEdit({{ $user->id }})">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="selectForDelete({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#delete-modal"> Delete </button>
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


    <!-- user modal -->
    <div wire:ignore.self id="user-modal" class="modal" tabindex="-1" aria-labelledby="role-and-permission" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="role-and-permission">User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submit">
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Mr. Example Name" wire:model="name">
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="example@email.com" wire:model="email">
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" wire:model="password">
                                @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Password</label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" wire:model="password_confirmation">
                                @error('password_confirmation')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="role-{{ $role->id }}" value="{{ $role->id }}" wire:model="role">
                            <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                        @endforeach
                        @error('role')
                        <div class="alert alert-danger" role="role">
                            {{ $message }}
                        </div>
                        @enderror
                        <br>
                        <button type="submit" class="btn btn-primary col-12">SUBMIT</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.user modal -->

    <!-- delete modal -->
    <div wire:ignore.self id="delete-modal" class="modal" tabindex="-1" aria-labelledby="delete-modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt="Delete"> <br>
                    <button type="button" class="btn btn-danger text-white" wire:click="destroy" data-bs-dismiss="modal"> Confirm Delete </button>
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.delete modal -->
</div>
