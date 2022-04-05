<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Expiration Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Expiration Page</li>
                </ol>
                <button type="button" wire:click="create" class="btn btn-dark d-none d-lg-block m-l-15" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus-circle"></i> @if($operator->expirations->count() > 0) Renew @else Create New @endif </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">Operarot Information</h4>
                    <b>Operator: </b> {{ $operator->name }} <br>
                    <b>Category: </b> {{ $operator->category->name ?? 'Not Found' }} <br>
                    <b>Sub Category: </b> {{ $operator->sub_category->name ?? 'Not Found' }}
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table success-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Issue Date</th>
                                    <th>Expire Date</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expirations as $expiration)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expiration->issue_date->format('d M Y') }}</td>
                                    <td>{{ $expiration->expire_date->format('d M Y') }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $expiration->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $expiration->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
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
                            <h4 class="modal-title" id="">Expiration Form</h4>
                            <x-loading />
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="issue_date" wire:model="issue_date" placeholder="" wire:change="calculate_iteration">
                                            <label for="issue_date">Issue date</label>
                                        </div>
                                        <x-error name="issue_date" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="date" class="form-control" id="expire_date" wire:model="expire_date" placeholder="">
                                            <label for="expire_date">Expire date</label>
                                        </div>
                                       <x-error name="expire_date" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="duration_year" wire:model="duration_year" placeholder="Year" wire:change="calculate_iteration">
                                            <label for="duration_year">Year</label>
                                        </div>
                                       <x-error name="duration_year" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="duration_month" wire:model="duration_month" placeholder="Month" wire:change="calculate_iteration">
                                            <label for="duration_month">Month</label>
                                        </div>
                                        <x-error name="duration_month" />
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
