<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Receive fee Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Receive fee Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>Create New</button>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($form)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name">Receive fee</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Receive fee name" aria-label="" wire:model="name">
                                   
                                    <div class="input-group-append">
                                        <button class="btn btn-lg btn-info" type="submit">Save!</button>
                                    </div>
                                </div>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
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
                                    <th>Upload at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receive_fees as $receive_fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $receive_fee->name }}</td>
                                    <td title="{{ $receive_fee->created_at->format('d/m/Y h:i A') }}">{{ $receive_fee->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $receive_fee->id }})">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="selectForDelete({{ $receive_fee->id }})" onclick="openModal()"> Delete </button>
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