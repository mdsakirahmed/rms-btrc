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
        @if($expirations->count() > 0)
        @foreach ($expirations as $count => $expiration)
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header @if($loop->odd) bg-success @else bg-primary @endif text-white d-flex justify-content-around">
                    <h4>Start: {{ $expiration->starting_date->format('d M Y') }}</h4>
                    <h4 style="background: red; border-radius:12px; padding:5px 15px 5px 15px;"><b>** {{ $loop->iteration }} **</b></h4>
                    <h4>Expire: {{ $expiration->ending_date->format('d M Y') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-bordered-table  @if($loop->odd) success-bordered-table @else primary-bordered-table @endif">
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
                                @foreach ($expiration->payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->payble_amount }} ৳</td>
                                    <td>{{ $payment->last_date_of_payment->format('d M Y') }}</td>
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
                                        <button class="btn btn-success" type="button" wire:click="select_payment_for_pay({{ $payment->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Pay</button>
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
        @endforeach
        @else
        <div class="col-12">
            <div class="alert alert-danger text-center" role="alert">
                <h1>Configration Not Found</h1>
            </div>
        </div>
        @endif
        <div class="col-12">
            <!-- sample modal content -->
            <div wire:ignore.self class="modal bs-example-modal-lg fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Payment Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    @if($payment_for_pay)
                                        <div class="col-md-12 text-center m-3">
                                            <h4 style="background: rgba(20, 5, 88, 0.822); border-radius:25px; margin: 0% 10% 0% 10%; padding: 20px 0px 20px 0px; font-size:30px; color:white; border: 5px solid @if($payment_for_pay->last_date_of_payment->isPast()) red @else green @endif;">
                                                <b>
                                                    {{ $payment_for_pay->payble_amount }} TAKA <br>
                                                    {{ $payment_for_pay->last_date_of_payment->format('d M Y') }} ({{ $payment_for_pay->last_date_of_payment->diffForHumans() }}) <br>
                                                    @if($payment_for_pay->last_date_of_payment->isPast())
                                                    <i class="text-danger">*Late fee include</i> <br>
                                                    @endif
                                                </b>
                                            </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input required type="number" class="form-control bg-success text-white" id="vat" wire:model="vat" placeholder="VAT">
                                                <label for="vat">VAT</label>
                                            </div>
                                            @error('vat')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            @if($payment_for_pay->last_date_of_payment->isPast())
                                            <div class="form-floating mb-3">
                                                <input required type="number" class="form-control bg-danger text-white" id="late_fee" wire:model="late_fee" placeholder="Late fee">
                                                <label for="late_fee">Late fee</label>
                                            </div>
                                            @error('late_fee')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="list-group">
                                                <input type="text" class="list-group-item list-group-item-action list-group-item-primary"/>
                                                @foreach ($banks as $bank)
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-secondary">{{ $bank->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="list-group">
                                                <input type="text" class="list-group-item list-group-item-action list-group-item-primary"/>
                                                @foreach ($branches as $branch)
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-secondary">{{ $branch->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3">
                                                <div class="ms-auto mt-3 mt-md-0">
                                                    <button type="submit" class="btn btn-success text-white">Submit</button>
                                                    <button type="button" class="btn btn-danger waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <div class="alert alert-success text-center" role="alert">
                                                <h1><b>Click on another pay</b></h1>
                                            </div>
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
