<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">License Category Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">License Category Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="create" alt="default" data-bs-toggle="modal" data-bs-target="#create_and_edit_modal"><i class="fa fa-plus-circle"></i>Create New</button>
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
                                    <th>License Fee</th>
                                    <th>Duration</th>
                                    <th>Payment Iteration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenseCategories as $licenseCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $licenseCategory->name }}</td>
                                    <td>{{ $licenseCategory->license_fee }}</td>
                                    <td>{{ $licenseCategory->duration_year }} years and {{ $licenseCategory->duration_month }}</td>
                                    <td>{{ $licenseCategory->payment_iteration }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $licenseCategory->id }})" alt="default" data-bs-toggle="modal" data-bs-target="#create_and_edit_modal">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="selectForDelete({{ $licenseCategory->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".delete_modal"> Delete </button>
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

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal bs-example-modal-lg fade delete_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt="Delete"> <br>
                    <button type="button" class="btn btn-danger text-white" wire:click="destroy" data-bs-dismiss="modal" aria-hidden="true"> Confirm Delete </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div wire:ignore.self class="modal bs-example-modal-lg fade" id="create_and_edit_modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title" id="">Category Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">License category name</label>
                            <input type="text" class="form-control" id="name" placeholder="License category name" wire:model="name">
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="license_fee">License fee</label>
                                <input type="number" class="form-control" id="license_fee" placeholder="Fee" wire:model="license_fee">
                                @error('license_fee')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="duration_year">Duration year</label>
                                <input type="number" class="form-control" id="duration_year" placeholder="Year" wire:model="duration_year" wire:change="calculate_iteration">
                                @error('duration_year')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="duration_month">Duration month</label>
                                <input type="number" class="form-control" id="duration_month" placeholder="Month" wire:model="duration_month" wire:change="calculate_iteration">
                                @error('duration_month')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="payment_iteration">Payment iteration ({{ $payment_iteration * 2 }} monthes)</label>
                                <input type="number" class="form-control" id="payment_iteration" placeholder="Iteration" min="0" step="1" wire:model="payment_iteration">
                                <small class="form-text text-muted">Only integer number accepted <b># {{ (int)$payment_iteration }}</b></small>

                                @error('payment_iteration')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-lg btn-info" type="submit">Save!</button>


                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
