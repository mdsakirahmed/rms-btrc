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
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>

    <div class="row">
        @if ($form)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                </div>
            </div>
        </div>
        @endif
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
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $user->id }})">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="selectForDelete({{ $user->id }})" onclick="openModal()"> Delete </button>
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

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
         <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt="Delete"> <br>
         <button type="button" class="btn btn-danger text-white" wire:click="destroy" onclick="closeModal()"> Confirm Delete </button>
         <button type="button" class="btn btn-secondary close-btn" onclick="closeModal()">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function openModal() {
        $('#delete_modal').modal('show');
    }
    function closeModal() {
        $('#delete_modal').modal('hide');
    } 
</script>
</div>