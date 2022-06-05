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
                        <table class="table color-table">
                            <thead  class="btrc">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Duration Year</th>
                                    <th>Duration Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenseCategories as $licenseCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $licenseCategory->name }}</td>
                                    <td>{{ $licenseCategory->duration_year }} year</td>
                                    <td>{{ $licenseCategory->duration_month }} month</td>
                                    <td>
                                        <a href="{{ route('licenseCategorywiseFee', $licenseCategory->id) }}" class="btn btn-primary">Fee Types</a>
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $licenseCategory->id }})" alt="default" data-bs-toggle="modal" data-bs-target="#create_and_edit_modal">Edit</button>
                                        <button type="button" class="btn btn-danger text-white confirmation_btn" wire:click="delete({{ $licenseCategory->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
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
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name">License Category Name</label>
                                <input type="text" class="form-control" id="name" placeholder="License Category Name" wire:model="name">
                                <x-error name="name" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="duration_year">Duration Year</label>
                                <input type="number" class="form-control" id="duration_year" placeholder="Year" wire:model="duration_year">
                                <x-error name="duration_year" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="duration_month">Duration Month</label>
                                <input type="number" class="form-control" id="duration_month" placeholder="Month" wire:model="duration_month">
                                <x-error name="duration_month" />
                            </div>
                        </div>
                        <button class="btn btn-lg btn-info" type="submit">Submit Now</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
