<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">License Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">License Page</li>
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
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Mr. Example Name" wire:model="name">
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                          <div class="form-group col-md-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="example@email.com" wire:model="email">
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone" wire:model="phone">
                            @error('phone')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address" wire:model="address">
                            @error('address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-4">
                            <label for="license_number">License Number</label>
                            <input type="text" class="form-control" id="license_number" placeholder="License number" wire:model="license_number">
                            @error('license_number')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-4">
                            <label for="fee">Fee</label>
                            <input type="number" class="form-control" id="fee" placeholder="Fee" wire:model="fee">
                            @error('fee')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-4">
                            <label for="instalment">Instalment</label>
                            <input type="number" class="form-control" id="instalment" placeholder="Instalment" wire:model="instalment">
                            @error('instalment')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group col-md-4">
                            <label for="license_category_id">License category</label>
                            <select wire:model="license_category_id" id="license_category_id" class="form-control form-select">
                                <option value="">Chose license category</option>
                                @foreach ($licenseCategories as $licenseCategory)
                                <option value="{{ $licenseCategory->id }}">{{ $licenseCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('license_category_id')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="license_sub_category_id">License sub category</label>
                            <select wire:model="license_sub_category_id" id="license_sub_category_id" class="form-control form-select">
                                <option value="">Chose license sub category</option>
                                @foreach ($licenseSubCategories as $licenseSubCategory)
                                <option value="{{ $licenseSubCategory->id }}">{{ $licenseSubCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('license_sub_category_id')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="expire_date">Expire date</label>
                            <input type="month" class="form-control" id="expire_date" placeholder="" wire:model="expire_date">
                            @error('expire_date')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
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
                                @foreach ($licenses as $license)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $license->name }}</td>
                                    <td>{{ $license->email }}</td>
                                    <td>{{ $license->roles}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="select({{ $license->id }}, 'true')">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="select({{ $license->id }})" onclick="openModal()"> Delete </button>
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