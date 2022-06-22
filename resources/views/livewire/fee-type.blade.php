<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Fee Type Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Fee Type Page</li>
                </ol>
                <button type="button" wire:click="create" class="btn btn-dark d-none d-lg-block m-l-15" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus-circle"></i> Create New</button>
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
                                    <th>Start With Issue</th>
                                    <th>Period Month</th>
                                    <th>Schedule</th>
                                    <th>Period Format</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fee_types as $fee_type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $fee_type->name }}
                                    </td>
                                    <td>{{ $fee_type->period_start_with_issue_date ? 'Yes' : 'No' }}</td>
                                    <td>{{ $fee_type->period_month }}</td>
                                    <td>
                                        {{ $fee_type->schedule_day }} Days & {{ $fee_type->schedule_month }} Months Include with @if($fee_type->schedule_include_to_beginning_of_period) Beginning @else Ending @endif of the Period</b>
                                    </td>
                                    <td>
                                        @if($fee_type->period_format == 1) Jan/2018-19 @elseif($fee_type->period_format == 2) Jan-Feb/2022 @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $fee_type->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $fee_type->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
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
            <div wire:ignore.self class="modal bs-example-modal-lg fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Fee Type Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter Name Here">
                                            <label for="name">Name</label>
                                        </div>
                                        <x-error name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="period_format" id="period_format" class="form-control" wire:model="period_format">
                                                <option value="">Chose Period Format</option>
                                                <option value="1">Jan/2022-2023</option>
                                                <option value="2">Jan-Feb/2022</option>
                                                <option value="2">Jan-Mar/2022</option>
                                            </select>
                                            <label for="period_format">Period Format</label>
                                        </div>
                                        <x-error name="period_format" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="schedule_include_to_beginning_of_period" id="schedule_include_to_beginning_of_period" class="form-control" wire:model="schedule_include_to_beginning_of_period">
                                                <option value="1">Beginning of the Period</option>
                                                <option value="0">End of the Period</option>
                                            </select>
                                            <label for="schedule_include_to_beginning_of_period">Schedule Beginning/End of Period </label>
                                        </div>
                                        <x-error name="schedule_include_to_beginning_of_period" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="period_start_with_issue_date" id="period_start_with_issue_date" class="form-control" wire:model="period_start_with_issue_date">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <label for="period_start_with_issue_date"> Period Start With Issue Date </label>
                                        </div>
                                        <x-error name="period_start_with_issue_date" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="schedule_day" wire:model="schedule_day" placeholder="Enter Schedule Day Here">
                                            <label for="schedule_day">Schedule Day</label>
                                        </div>
                                        <x-error name="schedule_day" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="schedule_month" wire:model="schedule_month" placeholder="Enter Schedule Month Here">
                                            <label for="schedule_month">Schedule Month</label>
                                        </div>
                                        <x-error name="schedule_month" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="period_month" wire:model="period_month" placeholder="Enter Period Month Here">
                                            <label for="period_month">Period Month</label>
                                        </div>
                                        <x-error name="period_month" />
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                                <button type="button" class="btn btn-danger waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
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
        </div>
    </div>
</div>
