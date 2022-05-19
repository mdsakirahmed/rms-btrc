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
            <div class="card">
                <div class="row m-3">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">{{ array_sum(array_column($receive_section_array,'receive_amount')) + array_sum(array_column($receive_section_array,'late_fee_receive_amount')) + array_sum(array_column($receive_section_array,'vat_receive_amount')) }}</h1>
                                <h6 class="text-white">Total Receive Amount</h6>
                            </div>
                            <div class="card-footer">
                                <a href="#receive" class="btn btn-info w-100 mt-2">Receive Section <i class="fa fa-pen"></i> </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">{{ array_sum(array_column($po_section_array,'po_amount')) }}</h1>
                                <h6 class="text-white">Total PO Amount</h6>
                            </div>
                            <div class="card-footer">
                                <a href="#po" class="btn btn-warning w-100 mt-2">PO Section <i class="fa fa-pen"></i> </a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">{{ array_sum(array_column($deposit_section_array,'deposit_amount')) }}</h1>
                                <h6 class="text-white">Total Deposit Amount</h6>
                            </div>
                            <div class="card-footer">
                                <a href="#deposit" class="btn btn-success w-100 mt-2">Deposit Section <i class="fa fa-pen"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group btn-group-lg col-12" role="group">
                        <a href="{{ route('payment') }}" class="btn btn-danger text-white">Reset All</a>
                        {{-- @if((array_sum(array_column($receive_section_array,'receive_amount')) + array_sum(array_column($receive_section_array,'late_fee_receive_amount')) + array_sum(array_column($receive_section_array,'vat_receive_amount')))
                        == array_sum(array_column($po_section_array,'po_amount')) && array_sum(array_column($po_section_array,'po_amount')) == array_sum(array_column($deposit_section_array,'deposit_amount'))) --}}
                        <button type="button" class="btn btn-success" wire:click="submit">Final Submit</button>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Operator Details <div wire:loading>
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required">Transaction Number</label>
                                <input type="text" class="form-control" disabled wire:model="transaction">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required" for="category">Select Category</label>
                                <select class="form-control form-select select2 filter category" id="category" name="category" wire:model="selected_category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (request()->category == $category->id)
                                        selected @endif>{{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-error name="selected_category" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required" for="sub_category">Sub-Category</label>
                                <select class="form-control form-select select2 filter sub_category" id="sub_category" name="sub_category" wire:model="selected_sub_category">
                                    <option value="">Select Sub Category</option>
                                    @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">
                                        {{ $sub_category->name }}</option>
                                    @endforeach
                                </select>
                                <x-error name="selected_sub_category" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Select Operator</label>
                                <select class="form-control form-select" wire:model="selected_operator">
                                    <option value="">Select Operator</option>
                                    @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}">
                                        {{ $operator->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-error name="selected_operator" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="receive">
                <div class="card-header bg-info text-white">
                    <h3>Receive details</h3>
                </div>
                @foreach ($receive_section_array as $key => $receive_section)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Fee Type</label>
                                <select class="form-control form-select" wire:model="receive_section_array.{{ $key }}.selected_fee_type" wire:change="fee_type_change({{ $key }})">
                                    <option value="">Select Fee Type</option>
                                    @foreach ($fee_types as $fee_type)
                                    <option value="{{ $fee_type->id }}">
                                        {{ $fee_type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-error name="receive_section_array.{{ $key }}.selected_fee_type" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Select Period</label>
                                <select class="form-control form-select" wire:model="receive_section_array.{{ $key }}.selected_period" wire:change="period_change({{ $key }})">
                                    <option value="">Select Period</option>
                                    @isset($receive_section_array[$key]['periods'])
                                    @foreach ($receive_section_array[$key]['periods'] as $period)
                                    <option value="{{ $period['id'] }}">
                                        {{ $period['period_label'] }}
                                    </option>
                                    @endforeach
                                    @endisset
                                </select>
                                <x-error name="receive_section_array.{{ $key }}.selected_period" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label">Schedule Date</label>
                                <input type="text" class="form-control mt-1" disabled wire:model="receive_section_array.{{ $key }}.schedule_date">
                                <x-error name="receive_section_array.{{ $key }}.schedule_date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Receive Date</label>
                                <input type="date" class="form-control" wire:model="receive_section_array.{{ $key }}.receive_date" wire:change="receive_date_change({{ $key }})">
                                <x-error name="receive_section_array.{{ $key }}.receive_date" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">Receivable</label>
                                <input type="number" class="form-control" disabled wire:model="receive_section_array.{{ $key }}.receivable">
                                <x-error name="receive_section_array.{{ $key }}.receivable" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">Receive</label>
                                <input type="number" class="form-control" step="0.001" wire:model="receive_section_array.{{ $key }}.receive_amount" wire:change="receive_amount_change({{ $key }}, $event.target.value)">
                                <x-error name="receive_section_array.{{ $key }}.receive_amount" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">
                                    Late Fee( <b class="text-success late_fee_title">@isset($receive_section_array[$key]['late_fee_percentage']) {{ $receive_section_array[$key]['late_fee_percentage'] ?? 0 }} @endisset </b>%
                                    @isset($receive_section_array[$key]['late_days']) for {{ $receive_section_array[$key]['late_days'] }} days @endisset)
                                </label>
                                <input type="number" class="form-control" step="0.001" wire:model="receive_section_array.{{ $key }}.late_fee_receive_amount">
                                <x-error name="receive_section_array.{{ $key }}.late_fee_receive_amount" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">VAT (<b class="text-success vat_title">@isset($receive_section_array[$key]['vat_percentage']) {{ $receive_section_array[$key]['vat_percentage'] ?? 0 }} @endisset</b>%)</label>
                                <input type="number" class="form-control" step="0.001" disabled wire:model="receive_section_array.{{ $key }}.vat_receive_amount">
                                <x-error name="receive_section_array.{{ $key }}.vat_receive_amount" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">TAX (<b class="text-success tax_title">@isset($receive_section_array[$key]['tax_percentage']) {{ $receive_section_array[$key]['tax_percentage'] ?? 0 }} @endisset</b>%)</label>
                                <input type="number" class="form-control" step="0.001" disabled wire:model="receive_section_array.{{ $key }}.tax_receive_amount">
                                <x-error name="receive_section_array.{{ $key }}.tax_receive_amount" />
                            </div>
                        </div>
                        <div class="col-2 mt-2">
                            <button type="button" class="btn btn-warning w-100 mt-4 cln_btn" title="Remove this one" wire:click="add_or_rm_section_array('receive', {{ $key }})"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card-footer">
                    <div class="btn-group btn-group-lg col-12" role="group">
                        <button type="button" class="btn btn-info" wire:click="add_or_rm_section_array('receive')"><i class="fa fa-plus"></i> Add Payment Receipt</button>
                        @if(count($receive_section_array) > 0)
                        <button type="button" class="btn btn-danger text-white" wire:click="reset_section('receive')"> <i class="fas fa-sync"></i> Reset Receive Information </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card" id="po">
                <div class="card-header bg-warning text-white">
                    <h3>PO details</h3>
                </div>
                @foreach ($po_section_array as $key => $po_section)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">PO Amount</label>
                                <input type="number" class="form-control" step="0.001" wire:model="po_section_array.{{ $key }}.po_amount">
                                <x-error name="po_section_array.{{ $key }}.po_amount" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">PO Number</label>
                                <input type="text" class="form-control" wire:model="po_section_array.{{ $key }}.po_number">
                                <x-error name="po_section_array.{{ $key }}.po_number" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">PO Date</label>
                                <input type="date" class="form-control" wire:model="po_section_array.{{ $key }}.po_date">
                                <x-error name="po_section_array.{{ $key }}.po_date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">PO Bank</label>
                                <select class="form-control form-select" wire:model="po_section_array.{{ $key }}.po_bank">
                                    <option value="">Select PO Bank</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">
                                        {{ $bank->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-error name="po_section_array.{{ $key }}.po_bank" />
                            </div>
                        </div>
                        <div class="col-2 mt-4">
                            <button type="button" class="btn btn-warning w-100 mt-2 cln_btn" title="Remove this one" wire:click="add_or_rm_section_array('po', {{ $key }})"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card-footer">
                    <div class="btn-group btn-group-lg col-12" role="group">
                        <button type="button" class="btn btn-info" wire:click="add_or_rm_section_array('po')"><i class="fa fa-plus"></i> Add PO</button>
                        @if(count($po_section_array) > 0)
                        <button type="button" class="btn btn-danger text-white" wire:click="reset_section('po')"> <i class="fas fa-sync"></i> Reset PO Information </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card" id="deposit">
                <div class="card-header bg-success text-white">
                    <h3>Deposit details</h3>
                </div>
                @foreach ($deposit_section_array as $key => $deposit_section)
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">Deposit Amount</label>
                                <input type="number" class="form-control" step="0.001" wire:model="deposit_section_array.{{ $key }}.deposit_amount">
                                <x-error name="deposit_section_array.{{ $key }}.deposit_amount" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label required">Journal Number</label>
                                <input type="text" class="form-control" wire:model="deposit_section_array.{{ $key }}.journal_number">
                                <x-error name="deposit_section_array.{{ $key }}.journal_number" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Deposit Date</label>
                                <input type="date" class="form-control" wire:model="deposit_section_array.{{ $key }}.deposit_date">
                                <x-error name="deposit_section_array.{{ $key }}.deposit_date" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="form-label required">Deposit Bank</label>
                                <select class="form-control form-select" wire:model="deposit_section_array.{{ $key }}.deposit_bank">
                                    <option value="">Select Deposit Bank</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">
                                        {{ $bank->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <x-error name="deposit_section_array.{{ $key }}.deposit_bank" />
                            </div>
                        </div>
                        <div class="col-2 mt-4">
                            <button type="button" class="btn btn-warning w-100 mt-2 cln_btn" title="Remove this one" wire:click="add_or_rm_section_array('po', {{ $key }})"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card-footer">
                    <div class="btn-group btn-group-lg col-12" role="group">
                        <button type="button" class="btn btn-info" wire:click="add_or_rm_section_array('deposit')"><i class="fa fa-plus"></i> Add Deposit</button>
                        @if(count($deposit_section_array) > 0)
                        <button type="button" class="btn btn-danger text-white" wire:click="reset_section('deposit')"> <i class="fas fa-sync"></i> Reset Depotit Information </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="btn-group btn-group-lg col-12 mb-5 mt-5" role="group">
                <a href="{{ route('payment') }}" class="btn btn-danger text-white">Reset All</a>
                {{-- @if((array_sum(array_column($receive_section_array,'receive_amount')) + array_sum(array_column($receive_section_array,'late_fee_receive_amount')) + array_sum(array_column($receive_section_array,'vat_receive_amount')))
                == array_sum(array_column($po_section_array,'po_amount')) && array_sum(array_column($po_section_array,'po_amount')) == array_sum(array_column($deposit_section_array,'deposit_amount'))) --}}
                <button type="button" class="btn btn-success" wire:click="submit">Final Submit</button>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>
