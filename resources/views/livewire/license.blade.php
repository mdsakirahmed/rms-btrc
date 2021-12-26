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
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="create"><i class="fa fa-plus-circle"></i>
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
                            <div class="form-group col-md-4">
                                <label for="license_number">License Number</label>
                                <input type="text" class="form-control" id="license_number" placeholder="License number" wire:model="license_number">
                                @error('license_number')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="fee">Fee</label>
                                <input type="number" class="form-control" id="fee" placeholder="Fee" wire:model="fee">
                                @error('fee')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="instalment">Instalment</label>
                                <input type="number" class="form-control" id="instalment" placeholder="Instalment" wire:model="instalment">
                                @error('instalment')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="expire_date">Expire date</label>
                                <input type="month" class="form-control" id="expire_date" placeholder="" wire:model="expire_date">
                                @error('expire_date')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="user_id">Chose user</label>
                                <select wire:model="user_id" id="user_id" class="form-control form-select">
                                    <option value="">Chose user</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
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
                                    <th>License</th>
                                    <th>Expire Date</th>
                                    <th>Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenses as $license)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $license->license_number }}</td>
                                    <td>{{ $license->expire_date }}</td>
                                    <td>{{ $license->fee}}/{{ $license->instalment }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#user-modal" wire:click="licenseHolder({{ $license->id }})">Payments</button>
                                        <button type="button" class="btn btn-primary" wire:click="select({{ $license->id }}, 'true')">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="select({{ $license->id }})" data-bs-toggle="modal" data-bs-target="#delete-modal"> Delete </button>
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
    <div wire:ignore.self class="modal bs-example-modal-sm" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt="Delete"> <br>
                    <button type="button" class="btn btn-danger text-white" wire:click="destroy" data-bs-dismiss="modal"> Confirm Delete </button>
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--/. Delete Modal -->
    <!-- User modal content -->
    <div wire:ignore.self class="modal bs-example-modal-lg" id="user-modal" tabindex="-1" aria-labelledby="" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-lg-3 text-center">
                            <a href="app-contact-detail.html"><img src="{{ asset($license_holder['image'] ?? '/assets/images/users/1.jpg' ) }}" width="90" alt="user" class="img-circle img-fluid"></a>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <h3 class="box-title m-b-0">{{ $license_holder['name'] ?? null }}</h3>
                            <address>
                                Email: {{ $license_holder['email'] ?? null }}<br>
                                Phone: {{ $license_holder['phone'] ?? null }}
                            </address>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    @if($payments)
                    <div class="table-responsive">
                        <table class="table color-bordered-table primary-bordered-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Last date of pay</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->last_date_of_payment }}</td>
                                    <td>
                                        @if($payment->paid)
                                        <span class="badge bg-success">PAID</span>
                                        @else
                                        <span class="badge bg-danger">DUE</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->paid)
                                        <button class="btn btn-danger" type="button" wire:click="changePaymentStatus({{ $payment->id }}, 'due')">Make Due</button>
                                        <button class="btn btn-dark" type="button" wire:click="downloadInvoice({{ $payment->id }}, 'due')">INV</button>
                                        @else
                                        <form wire:submit.prevent="changePaymentStatus({{ $payment->id }}, 'paid')">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" aria-label="Transaction ID" wire:model="transaction_id.{{ $payment->id }}">
                                                <div class="input-group-append">
                                                    <select class="form-control form-select" data-placeholder="Choose a Category" wire:model="payment_method.{{ $payment->id }}">
                                                        <option value="">Payment method</option>
                                                        @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button class="btn btn-success" type="submit">Make Paid</button>
                                            </div>
                                            @error('transaction_id')
                                            <div class="alert alert-danger" role="alert">
                                               {{ $message }}
                                            </div>
                                            @enderror
                                            @error('payment_method')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
