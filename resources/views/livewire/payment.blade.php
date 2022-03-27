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
            <div class="card" style="border-radius:15px 15px 0px 0px;">
                <div class="card-body row">
                    <div class="col-md-4" style="height:3in; overflow:scroll;">
                        <div class="list-group">
                            <input type="text" wire:model="category_search_key" class="text-center text-white" placeholder="Search category" style="height: 60px; background:#3C3176; font-size:20px; border-radius:15px 15px 0px 0px; border: 0px;" />
                            @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                            <a href="javascript:void(0)" wire:click="chose_category({{ $category->id }})" class=" @if ($category->id == $category_id) bg-success text-white @endif list-group-item list-group-item-action list-group-item-secondary">{{ $category->name }}</a>
                            @endforeach
                            @else
                            <div class="alert alert-warning text-center" role="alert">
                                <b>Category Not Found</b>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4" style="height:3in; overflow:scroll;">
                        <div class="list-group">
                            <input type="text" wire:model="sub_category_search_key" class="text-center text-white" placeholder="Search sub category" style="height: 60px; background:#3C3176; font-size:20px; border-radius:15px 15px 0px 0px; border: 0px;" />
                            @if ($sub_categories->count() > 0)
                            @foreach ($sub_categories as $sub_category)
                            <a href="javascript:void(0)" wire:click="chose_sub_category({{ $sub_category->id }})" class=" @if ($sub_category->id == $sub_category_id) bg-success text-white @endif list-group-item list-group-item-action list-group-item-secondary">{{ $sub_category->name }}</a>
                            @endforeach
                            @else
                            <div class="alert alert-warning text-center" role="alert">
                                <b>Sub category Not Found</b>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4" style="height:3in; overflow:scroll;">
                        <div class="list-group">
                            <input type="text" wire:model="operator_search_key" class="text-center text-white" placeholder="Search operator" style="height: 60px; background:#3C3176; font-size:20px; border-radius:15px 15px 0px 0px; border: 0px;" />
                            @if ($operators->count() > 0)
                            @foreach ($operators as $operator_1)
                            <a href="javascript:void(0)" wire:click="chose_operator({{ $operator_1->id }})" class=" @if ($operator_1->id == $operator_id) bg-success text-white @endif list-group-item list-group-item-action list-group-item-secondary">{{ $operator_1->name }}</a>
                            @endforeach
                            @else
                            <div class="alert alert-warning text-center" role="alert">
                                <b>Operator Not Found</b>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($operator)
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
        @endif

        @if ($expirations->count() > 0)
        @foreach ($expirations as $expiration)
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header @if ($loop->odd) bg-success @else bg-primary @endif text-white d-flex justify-content-around">
                    <h4>Start: {{ $expiration->issue_date->format('d M Y') }}</h4>
                    <h4 style="background: red; border-radius:12px; padding:5px 15px 5px 15px;"><b>**
                            {{ $loop->iteration }} **</b></h4>
                    <h4>Expire: {{ $expiration->expire_date->format('d M Y') }}</h4>
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
                                        @if ($payment->paid)
                                        <span class="badge bg-success">PAID</span>
                                        @else
                                        <span class="badge bg-danger">DUE</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->paid)
                                        <button class="btn btn-dark" type="button" wire:click="download_invoice({{ $payment->id }})">INV</button>
                                        @else
                                        <button class="btn btn-success" type="button" wire:click="select_payment_for_pay({{ $payment->id }})" alt="default" data-bs-toggle="modal" data-bs-target="#payment_modal">Pay</button>
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
            <div wire:ignore.self class="modal bs-example-modal-lg fade" id="payment_modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Payment Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    @if ($payment_for_pay)
                                    <div class="col-md-12 text-center m-3">
                                        <h4 style="background: rgba(20, 5, 88, 0.822); border-radius:25px; margin: 0% 10% 0% 10%; padding: 20px 0px 20px 0px; font-size:30px; color:white; border: 5px solid @if ($payment_for_pay->last_date_of_payment->isPast()) red @else green @endif;">
                                            <b>
                                                {{ $payment_for_pay->payble_amount }} TAKA <br>
                                                {{ $payment_for_pay->last_date_of_payment->format('d M Y') }}
                                                ({{ $payment_for_pay->last_date_of_payment->diffForHumans() }})
                                                <br>
                                                @if ($payment_for_pay->last_date_of_payment->isPast())
                                                <i class="text-danger">*Late fee include</i> <br>
                                                @endif
                                            </b>
                                        </h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input required type="number" class="form-control bg-success text-white text-center" id="vat" wire:model="vat" placeholder="VAT">
                                            <label for="vat">VAT</label>
                                        </div>
                                        <x-error name="vat" />
                                    </div>
                                    <div class="col-md-6">
                                        @if ($payment_for_pay->last_date_of_payment->isPast())
                                        <div class="form-floating mb-3">
                                            <input required type="number" class="form-control bg-danger text-white text-center" id="late_fee" wire:model="late_fee" placeholder="Late fee">
                                            <label for="late_fee">Late fee</label>
                                        </div>
                                        <x-error name="late_fee" />
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <x-error name="bank_id" />
                                        <div class="list-group">
                                            <input type="text" wire:model="bank_search_key" class="text-center text-white" placeholder="Search bank" style="height: 60px; background:#3C3176; font-size:20px; border-radius:15px 15px 0px 0px; border: 0px;" />
                                            @if ($banks->count() > 0)
                                            @foreach ($banks as $bank)
                                            <a href="javascript:void(0)" wire:click="chose_bank({{ $bank->id }})" class=" @if ($bank->id == $bank_id) bg-success text-white @endif list-group-item list-group-item-action list-group-item-secondary">{{ $bank->name }}</a>
                                            @endforeach
                                            @else
                                            <div class="alert alert-warning text-center" role="alert">
                                                <b>Bank Not Found</b>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <x-error name="branch_id" />
                                        @if ($bank_id)
                                        <div class="list-group">
                                            <input type="text" wire:model="branch_search_key" class="text-white text-center" placeholder="Search branch" style="height: 60px; background:#3C3176; font-size:20px; border-radius:15px 15px 0px 0px; border: 0px;" />
                                            @if ($branches->count() > 0)
                                            @foreach ($branches as $branch)
                                            <a href="javascript:void(0)" wire:click="chose_branch({{ $branch->id }})" class="  @if ($branch->id == $branch_id) bg-success text-white @endif list-group-item list-group-item-action list-group-item-secondary">{{ $branch->name }}</a>
                                            @endforeach
                                            @else
                                            <div class="alert alert-warning text-center" role="alert">
                                                <b>Branch Not Found</b>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
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
