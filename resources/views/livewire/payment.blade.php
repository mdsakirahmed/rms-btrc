<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Payment Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>Create New</button>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="search">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-lg" id="license_number" placeholder="License number" aria-label="" wire:model="license_number">
                                    <div class="input-group-append">
                                        <button class="btn btn-lg btn-info" type="submit">Search</button>
                                    </div>
                                </div>
                                @error('license_number')
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

        @if($payments)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                                        <button class="btn btn-dark" type="button" wire:click="downloadInvoice({{ $payment->id }})">INV</button>
                                        @else
                                        <button class="btn btn-success" type="button" wire:click="makePayment({{ $payment->id }})">Pay</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-danger text-center" role="alert">
                <h1>Not found</h1>
            </div>
        </div>
        @endif
    </div>
    <!-- payment modal -->
    <div wire:ignore.self id="payment-modal" class="modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Make payment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="makePayment">
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Mr. Example Name" wire:model="name">
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="example@email.com" wire:model="email">
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" wire:model="password">
                                @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Password</label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" wire:model="password_confirmation">
                                @error('password_confirmation')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-12">SUBMIT</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.payment modal -->
</div>
