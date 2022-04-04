<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Fee types setting</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('license-category') }}">{{ $license_category->name }}</a></li>
                    <li class="breadcrumb-item active">Fees types setting</li>
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
                                    <th>Fee type name</th>
                                    <th>Iteration</th>
                                    <th>Amount</th>
                                    <th>Late fee</th>
                                    <th>Vat</th>
                                    <th>Tax</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category_wise_fees as $category_wise_fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category_wise_fee->fee_type->name ?? 'Not found' }}</td>
                                    <td>{{ $category_wise_fee->iteration }} </td>
                                    <td>{{ $category_wise_fee->amount }} BDT</td>
                                    <td>{{ $category_wise_fee->late_fee }} %</td>
                                    <td>{{ $category_wise_fee->vat }} %</td>
                                    <td>{{ $category_wise_fee->tax }} %</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $category_wise_fee->id }})" alt="default" data-bs-toggle="modal" data-bs-target="#create_and_edit_modal">Edit</button>
                                        <button type="button" class="btn btn-danger text-white confirmation_btn" wire:click="delete({{ $category_wise_fee->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
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
                            <div class="form-group col-md-2">
                                <label for="fee_type">Fee type</label>
                                <select class="form-control" id="fee_type" wire:model="fee_type">
                                    <option value="">Select fee type</option>
                                    @foreach ($fee_types as $fee_type)
                                    <option value="{{ $fee_type->id }}">{{ $fee_type->name }}</option>
                                    @endforeach
                                </select>
                                <x-error name="fee_type" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="iteration">Iteration</label>
                                <input type="number" class="form-control" id="iteration" placeholder="iteration" min="0" step="1" wire:model="iteration">
                                <x-error name="iteration" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" placeholder="amount" min="0" step="1" wire:model="amount">
                                <x-error name="amount" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="late_fee">Late fee %</label>
                                <input type="number" class="form-control" id="late_fee" placeholder="Late fee" min="0" step="1" wire:model="late_fee">
                                <x-error name="late_fee" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="vat">Vat %</label>
                                <input type="number" class="form-control" id="vat" placeholder="vat" min="0" step="1" wire:model="vat">
                                <x-error name="vat" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tax">Tax %</label>
                                <input type="number" class="form-control" id="tax" placeholder="tax" min="0" step="1" wire:model="tax">
                                <x-error name="tax" />
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
