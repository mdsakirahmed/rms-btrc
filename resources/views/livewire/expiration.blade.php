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
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th style="text-align: right;">Total Price</th>
                                    <th style="text-align: right;">Total Iteration</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expirations as $expiration)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expiration->issue_date->format('d M Y') }}</td>
                                    <td>{{ $expiration->expire_date->format('d M Y') }}</td>
                                    <td style="text-align: right;">{{ $expiration->price }} ৳</td>
                                    <td style="text-align: right;">{{ $expiration->iteration }}</td>
                                    <td style="text-align: center;">
                                        {{-- @if($expiration->payments()->where('paid', true)->count() > 0) --}}
                                        {{-- <i class="text-danger">{{ $expiration->payments()->where('paid', true)->count() }} payments</i> --}}
                                        {{-- @else --}}
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $expiration->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $expiration->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
                                        {{-- @endif --}}
                                        <br>
                                        <a href="{{ route('payment', ['operator' => $operator, 'expiration' => $expiration]) }}" class="btn btn-success text-white">Payments</a>
                                        <button type="button" class="btn btn-success btn-sm text-white" wire:click="download_payment_schedule({{ $expiration->id }})"> Download Payment Schedule </button>
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
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="issue_date" wire:model="issue_date" placeholder="" wire:change="calculate_iteration">
                                            <label for="issue_date">Issue date</label>
                                        </div>
                                        <x-error name="issue_date" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="date" class="form-control" id="expire_date" wire:model="expire_date" placeholder="">
                                            <label for="expire_date">Expire date</label>
                                        </div>
                                       <x-error name="expire_date" />
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" id="iteration" wire:model="iteration" wire:change="change_expire_date" placeholder="Total iteration" min="0" step="1">
                                            <label for="iteration">Total iteration ({{ $iteration * 2 }} monthes)</label>
                                            <small class="form-text text-muted">Only integer number accepted <b># {{ (int)$iteration }}</b></small>
                                        </div>
                                        <x-error name="iteration" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="price" wire:model="price" placeholder="Total price">
                                            <label for="price">Total price</label>
                                        </div>
                                       <x-error name="price" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="fee" wire:model="fee" placeholder="License fee">
                                            <label for="fee">License fee</label>
                                        </div>
                                        <x-error name="fee" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="duration_year" wire:model="duration_year" placeholder="Year" wire:change="calculate_iteration">
                                            <label for="duration_year">Year</label>
                                        </div>
                                       <x-error name="duration_year" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="duration_month" wire:model="duration_month" placeholder="Month" wire:change="calculate_iteration">
                                            <label for="duration_month">Month</label>
                                        </div>
                                        <x-error name="duration_month" />
                                    </div>
                                    @if($operator)
                                    <div class="col-md-6">
                                        <small class="form-text text-muted">License category name: <b># {{ $operator->category->name }}</b></small> <br>
                                        <small class="form-text text-muted">Default license fee: <b># {{ $operator->category->license_fee }}</b></small> <br>
                                        <small class="form-text text-muted">Default duration year: <b># {{ $operator->category->duration_year }}</b></small> <br>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="form-text text-muted">Default duration month: <b># {{ $operator->category->duration_month }}</b></small> <br>
                                        <small class="form-text text-muted">Default payment iteration: <b># {{ $operator->category->payment_iteration }}</b></small> <br>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                                <button type="button" class="btn btn-danger waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                    @if($operator)
                                    <div class="col-12">

                                    </div>
                                    @endif
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
