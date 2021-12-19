<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Permission Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Permission Page</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">Role and permission management</h4>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs customtab2" role="tablist">
                        <li class="nav-item" wire:click="tabChange('role')"> <a class="nav-link @if($tab == 'role') active @endif" data-bs-toggle="tab" href="#role" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-role"></i></span> <span class="hidden-xs-down">Role</span></a> </li>
                        <li class="nav-item" wire:click="tabChange('permission')"> <a class="nav-link @if($tab == 'permission') active @endif" data-bs-toggle="tab" href="#permission" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-role"></i></span> <span class="hidden-xs-down">Permission</span></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane @if($tab == 'role') active @endif" id="role" role="tabpanel">
                            <div class="p-20">
                                <div class="button-group">
                                    <button type="button" class="btn waves-effect waves-light btn-success" data-bs-toggle="modal" data-bs-target="#role-modal" wire:click="createRole">Add new role</button>
                                 </div>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Permission</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><span class="badge bg-success">{{ $role->name }}</span></td>
                                            <td>{{ $role->permissions->count() }}</td>
                                            <td>{{ $role->users->count() }}</td>
                                            <td>
                                                <button type="button" class="btn waves-waves-light btn-info" data-bs-toggle="modal" data-bs-target="#role-modal" wire:click="selectRole({{ $role->id }})">Edit</button>
                                                <button type="button" class="btn waves-waves-light btn-danger text-white" wire:click="deleteRole({{ $role->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane @if($tab == 'permission') active @endif" id="permission" role="tabpanel">
                            <div class="p-20">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Roles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><span class="badge bg-success">{{ $permission->name }}</span></td>
                                            <td>
                                                @foreach ($permission->roles as $role)
                                                <span class="badge @if($loop->odd) bg-info @else bg-dark @endif btn m-1">
                                                    {{ $role->name }} ({{ $role->users->count() }})
                                                </span>
                                                @endforeach
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
    </div>
    <!-- role modal -->
    <div wire:ignore.self id="role-modal" class="modal" tabindex="-1" aria-labelledby="role-and-permission" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="role-and-permission">Role and permission</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form  wire:submit.prevent="submitRole">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="tb-fname" placeholder="Enter role here" wire:model="role_name">
                            <label for="tb-fname">Role Name</label>
                        </div>
                        @error('role_name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        @foreach ($permissions as $permission)
                        <label class="badge bg-success btn m-1" for="permission_no_{{ $permission->id }}">
                            <input type="checkbox" class="form-check-input" id="permission_no_{{ $permission->id }}" value="{{ $permission->id }}" wire:model="selected_permissions.{{ $permission->id }}"> {{ $permission->name }}
                        </label>
                        @endforeach
                        @error('selected_permissions.*')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn waves-effect waves-light btn-danger col-12">SUBMIT</button>
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
    <!-- /.role modal -->
</div>
