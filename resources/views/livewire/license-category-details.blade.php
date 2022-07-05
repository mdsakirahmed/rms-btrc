<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Category Configration</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Category Configration</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-title d-flex justify-content-between">
                    <p class="m-2 fw-bold">Fee Type</p>
                    <button type="button" wire:click="create_fee_type" class="btn btn-dark d-none d-lg-block m-l-15"
                            data-bs-toggle="modal" data-bs-target="#fee_type_modal"><i class="fa fa-plus-circle"></i>
                        Add
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table">
                            <thead class="btrc">
                            <tr>
                                <th>Name</th>
                                <th>Sub category</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($fee_types as $fee_type)
                                <tr>
                                    <td>{{ $fee_type->name }}</td>
                                    <td>{{ $fee_type->sub_category->name ?? 'N/A' }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary btn-xs"
                                                wire:click="select_for_edit({{ $fee_type->id }})" alt="default"
                                                data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs text-white"
                                                wire:click="delete({{ $fee_type->id }})"
                                                onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-title d-flex justify-content-between">
                    <p class="m-2 fw-bold">Sub Category</p>
                    <button type="button" wire:click="create_sub_category" class="btn btn-dark d-none d-lg-block m-l-15"
                            data-bs-toggle="modal" data-bs-target="#sub_category_modal"><i
                                class="fa fa-plus-circle"></i> Add
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table">
                            <thead class="btrc">
                            <tr>
                                <th>Sub Categories</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sub_categories as $sub_category)
                                <tr>
                                    <td> {{ $sub_category->name }} </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary btn-xs"
                                                wire:click="select_sub_category({{ $sub_category->id }})"
                                                data-bs-toggle="modal" data-bs-target="#sub_category_modal">Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs text-white"
                                                wire:click="select_sub_category({{ $sub_category->id }})"
                                                data-bs-toggle="modal" data-bs-target="#delete_sub_category_modal">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <!-- sample modal content -->
            <div wire:ignore.self class="modal bs-example-modal-lg fade" id="fee_type_modal" tabindex="-1"
                 data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Fee Type Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit_fee_type">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="name">Fee Name</label>
                                        <input type="text" class="form-control @error("name") border-danger @enderror" id="name" wire:model="name" >
                                    </div>
                                    <div class="col">
                                        <label for="schedule_day">Schedule Day</label>
                                        <input type="number" class="form-control @error("schedule_day") border-danger @enderror" id="schedule_day"
                                               wire:model="schedule_day">
                                    </div>
                                    <div class="col">
                                        <label for="schedule_month">Schedule Month</label>
                                        <input type="number" class="form-control @error("schedule_month") border-danger @enderror" id="schedule_month"
                                               wire:model="schedule_month">
                                    </div>
                                    <div class="col">
                                        <label for="schedule_subtract_day">Schedule -Day</label>
                                        <input type="number" class="form-control @error("schedule_subtract_day") border-danger @enderror" id="schedule_subtract_day"
                                               wire:model="schedule_subtract_day">
                                    </div>
                                    <div class="col">
                                        <label for="period_month">Period Month</label>
                                        <input type="number" class="form-control @error("period_month") border-danger @enderror" id="period_month"
                                               wire:model="period_month">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="period_format">Period Format</label>
                                        <select name="period_format" id="period_format" class="form-control @error("period_format") border-danger @enderror"
                                                wire:model="period_format">
                                            <option value="">Chose Period Format</option>
                                            <option value="1">Jan/2022-2023</option>
                                            <option value="2">Jan-Feb/2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="schedule_include_to_beginning_of_period">Beginning/End</label>
                                        <select name="schedule_include_to_beginning_of_period" title="Schedule Beginning/End of Period"
                                                id="schedule_include_to_beginning_of_period" class="form-control @error("schedule_include_to_beginning_of_period") border-danger @enderror"
                                                wire:model="schedule_include_to_beginning_of_period">
                                            <option value="">Chose</option>
                                            <option value="1">Beginning of the Period</option>
                                            <option value="0">End of the Period</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="period_start_with_issue_date"> Start at Issue </label>
                                        <select name="period_start_with_issue_date" id="period_start_with_issue_date"
                                                class="form-control @error("period_start_with_issue_date") border-danger @enderror" wire:model="period_start_with_issue_date">
                                            <option value="">Chose</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="period_start_with_issue_date"> Sub Category </label>
                                        <select name="period_start_with_issue_date" id="sub_category_id"
                                                class="form-control @error("sub_category_id") border-danger @enderror" wire:model="sub_category_id">
                                            <option value="">Chose</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-4"></div>
                                    <div class="col-md-3">
                                        <label for="amount" class="required">Amount</label>
                                        <input type="number"
                                               class="form-control @error("amount") border-danger @enderror" id="amount"
                                               placeholder="amount" min="0" step="0.001" wire:model="amount">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="late_fee" class="required">Late Fee %</label>
                                        <input type="number"
                                               class="form-control @error("late_fee") border-danger @enderror"
                                               id="late_fee" placeholder="Late Fee" min="0" step="0.001"
                                               wire:model="late_fee">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="vat" class="required">VAT %</label>
                                        <input type="number" class="form-control @error("vat") border-danger @enderror"
                                               id="vat" placeholder="vat" min="0" step="0.001" wire:model="vat">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tax" class="required">Tax %</label>
                                        <input type="number" class="form-control @error("tax") border-danger @enderror"
                                               id="tax" placeholder="tax" min="0" step="0.001" wire:model="tax">
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                                <button type="button"
                                                        class="btn btn-danger waves-effect text-start text-white"
                                                        data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- sub_category_modal modal content -->
            <div wire:ignore.self class="modal bs-example-modal-lg fade" id="sub_category_modal" tabindex="-1"
                 data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Sub category Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit_sub_category">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="sub_category_name"
                                                   wire:model="sub_category_name" placeholder="Enter Sub Category Name">
                                            <label for="sub_category_name">Name</label>
                                        </div>
                                        <x-error name="sub_category_name"/>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                                <button type="reset" class="btn btn-warning text-white">Reset</button>
                                                <button type="button"
                                                        class="btn btn-dark waves-effect text-start text-white"
                                                        data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.sub_category_modal modal -->
            <!-- sub_category_modal delete modal content -->
            <div wire:ignore.self class="modal delete-modal fade" tabindex="-1" id="delete_sub_category_modal"
                 data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt=""> <br>
                            <button class="btn btn-danger text-white" data-bs-dismiss="modal"
                                    wire:click="delete_sub_category">Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.sub_category_modal modal -->
        </div>
    </div>
</div>
