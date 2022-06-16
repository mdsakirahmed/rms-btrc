<div>
    <style>
        .btn {
            margin-top: 13px;
        }

        .form-group {
            margin-bottom: 3px;
        }

        .card {
            /* border: 1px solid rgb(191, 190, 190); */
            margin-bottom: 5px;
        }

        .card-body {
            padding: 0.25rem 0.25rem;
        }

        .page-titles {
            background: #fff;
            padding: 5px 5px;
            box-shadow: 1px 0 20 pxrgba(0, 0, 0, .08);
            margin: 0 -25px 10px -25px;
        }

    </style>

    <div class="row page-titles">
        <div class="col-md-4 card text-center">
            <h6 class="fw-bold">{{ round(array_sum(array_column($receive_section_array,'receive_amount')) + array_sum(array_column($receive_section_array,'late_fee_receive_amount')) + array_sum(array_column($receive_section_array,'vat_receive_amount'))) }}
                Collection</h6>
        </div>
        <div class="col-md-4 card text-center">
            <h6 class="fw-bold">{{ round(array_sum(array_column($po_section_array,'po_amount'))) }} PO</h6>
        </div>
        <div class="col-md-4 card text-center">
            <h6 class="fw-bold">{{ round(array_sum(array_column($deposit_section_array,'deposit_amount'))) }}
                Deposit</h6>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required">Transaction Number</label>
                                <input type="text"
                                       class="form-control form-control-sm  @error('transaction') has-danger @enderror"
                                       disabled wire:model="transaction">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required">Select Category</label>
                                <select class="form-select form-select-sm  @error('selected_category') bg-danger @enderror"
                                        wire:model="selected_category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (request()->category == $category->id)
                                            selected @endif>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required">Sub-Category</label>
                                <select class="form-select form-select-sm @error('selected_sub_category') bg-danger @enderror"
                                        wire:model="selected_sub_category">
                                    <option value="">Select Sub Category</option>
                                    @foreach ($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->id }}">
                                            {{ $sub_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label required">Select Operator</label>
                                <select class="form-select form-select-sm  @error('selected_operator') bg-danger @enderror"
                                        wire:model="selected_operator">
                                    <option value="">Select Operator</option>
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->id }}">
                                            {{ $operator->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="receive">
                    {{-- <div style="display: flex; justify-content: space-between; width:100%;">
                        <h6 class="fw-bold">Collection Details</h6>
                        <button type="button" class="btn btn-sm text-white" wire:click="reset_section('receive')" style="background:#D4D4D4;"><i class="fas fa-sync"></i> Reset </button>
                    </div> --}}
                    @foreach (array_reverse($receive_section_array, true) as $key => $receive_section)
                        <div class="receive-row-{{ $key }}">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label required">Fee Type</label>
                                        <select class="form-select form-select-sm @error("receive_section_array.$key.selected_fee_type") bg-danger @enderror"
                                                @if($receive_section_array[$key]['lock'] ?? false) disabled
                                                @endif wire:model="receive_section_array.{{ $key }}.selected_fee_type"
                                                wire:change="fee_type_change({{ $key }})">
                                            <option value="">Select Fee Type</option>
                                            @foreach ($fee_types as $fee_type)
                                                <option value="{{ $fee_type->id }}">
                                                    {{ $fee_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label required">Select Period</label>
                                        <select class="form-select form-select-sm @error("receive_section_array.$key.selected_period") bg-danger @enderror"
                                                @if($receive_section_array[$key]['lock'] ?? false) disabled
                                                @endif wire:model="receive_section_array.{{ $key }}.selected_period"
                                                wire:change="period_change({{ $key }})">
                                            <option value="">Select Period</option>
                                            @isset($receive_section_array[$key]['periods'])
                                                @foreach ($receive_section_array[$key]['periods'] as $period)
                                                    <option value="{{ $period['id'] }}">
                                                        {{ $period['period_label'] }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.schedule_date") has-danger @enderror">
                                        <label class="form-label">Schedule Date</label>
                                        <input type="text" class="form-control form-control-sm mt-1" disabled
                                               wire:model="receive_section_array.{{ $key }}.schedule_date">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.receive_date") has-danger @enderror">
                                        <label class="form-label required">Collection Date</label>
                                        <input type="date" class="form-control form-control-sm"
                                               @if($receive_section_array[$key]['lock'] ?? false) disabled
                                               @endif wire:model="receive_section_array.{{ $key }}.receive_date"
                                               wire:change="receive_date_change({{ $key }})">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.receivable") has-danger @enderror">
                                        <label class="form-label required">Receivable</label>
                                        <input type="number" class="form-control form-control-sm"
                                               @if($receive_section_array[$key]['lock'] ?? false) disabled
                                               @endif @if($receive_section_array[$key]['receivable_field_disabled'] ?? false) disabled
                                               @endif wire:model="receive_section_array.{{ $key }}.receivable">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.receive_amount") has-danger @enderror">
                                        <label class="form-label required">Collection</label>
                                        <input type="number" class="form-control form-control-sm" step="0.001"
                                               @if($receive_section_array[$key]['lock'] ?? false) disabled
                                               @endif wire:model="receive_section_array.{{ $key }}.receive_amount"
                                               wire:change="receive_amount_change({{ $key }}, $event.target.value)">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.late_fee_receive_amount") has-danger @enderror">
                                        <label class="form-label required">
                                            Late Fee( <b
                                                    class="text-success late_fee_title">@isset($receive_section_array[$key]['late_fee_percentage'])
                                                    {{ $receive_section_array[$key]['late_fee_percentage'] ?? 0 }}
                                                @endisset </b>%)
                                        </label>
                                        <input type="number" class="form-control form-control-sm" step="0.001"
                                               @if($receive_section_array[$key]['lock'] ?? false) disabled
                                               @endif wire:model="receive_section_array.{{ $key }}.late_fee_receive_amount"
                                               title="@isset($receive_section_array[$key]['late_days']) for {{ $receive_section_array[$key]['late_days'] }} days @endisset">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.vat_receive_amount") has-danger @enderror">
                                        <label class="form-label required">VAT (<b
                                                    class="text-success vat_title">@isset($receive_section_array[$key]['vat_percentage'])
                                                    {{ $receive_section_array[$key]['vat_percentage'] ?? 0 }}
                                                @endisset</b>%)</label>
                                        <input type="number" class="form-control form-control-sm" step="0.001" disabled
                                               wire:model="receive_section_array.{{ $key }}.vat_receive_amount">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group @error("receive_section_array.$key.tax_receive_amount") has-danger @enderror">
                                        <label class="form-label required">TAX (<b
                                                    class="text-success tax_title">@isset($receive_section_array[$key]['tax_percentage'])
                                                    {{ $receive_section_array[$key]['tax_percentage'] ?? 0 }}
                                                @endisset</b>%)</label>
                                        <input type="number" class="form-control form-control-sm" step="0.001" disabled
                                               wire:model="receive_section_array.{{ $key }}.tax_receive_amount">
                                    </div>
                                </div>
                                <div class="col mt-4">
                                    @if($loop->first)
                                        <button type="button" class="btn btn-sm text-white fw-bold"
                                                wire:click="add_or_rm_section_array('receive')"
                                                style="background: #0AADD1; width:45%;"><i class="fa fa-plus"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm text-white fw-bold"
                                                wire:click="add_or_rm_section_array('receive', {{ $key }})"
                                                style="background: #eb5858; width:45%;"><i class="fa fa-minus"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-sm text-white fw-bold"
                                            wire:click="make_as_lock_or_unlock('receive', {{ $key }})"
                                            style="background: #A9A9A9; width:45%;"><i class="fa fa-lock"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="po">
                    {{-- <div style=" display: flex; justify-content: space-between; width:100%;">
                        <h6 class="fw-bold">PO Details</h6>
                        <button type="button" class="btn btn-sm text-white" wire:click="reset_section('po')" style="background:#D4D4D4;"><i class="fas fa-sync"></i> Reset </button>
                    </div> --}}
                    @foreach (array_reverse($po_section_array, true) as $key => $po_section)
                        <div class="row">
                            <div class="col">
                                <div class="form-group @error("po_section_array.$key.po_amount") has-danger @enderror">
                                    <label class="form-label required">PO Amount</label>
                                    <input type="number" class="form-control form-control-sm" step="0.001"
                                           @if($po_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="po_section_array.{{ $key }}.po_amount">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group @error("po_section_array.$key.po_date") has-danger @enderror">
                                    <label class="form-label required">PO Date</label>
                                    <input type="date" class="form-control form-control-sm"
                                           @if($po_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="po_section_array.{{ $key }}.po_date">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label required">PO Bank</label>
                                    <select class="form-select form-select-sm @error("po_section_array.$key.po_bank") bg-danger @enderror"
                                            @if($po_section_array[$key]['lock'] ?? false) disabled
                                            @endif wire:model="po_section_array.{{ $key }}.po_bank">
                                        <option value="">Select PO Bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">
                                                {{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group @error("po_section_array.$key.po_number") has-danger @enderror">
                                    <label class="form-label required">PO Number</label>
                                    <input type="text" class="form-control form-control-sm"
                                           @if($po_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="po_section_array.{{ $key }}.po_number">
                                </div>
                            </div>
                            <div class="col mt-4">
                                @if($loop->first)
                                    <button type="button" class="btn btn-sm text-white fw-bold"
                                            wire:click="add_or_rm_section_array('po')"
                                            style="background: #0AADD1; width:45%;"><i class="fa fa-plus"></i></button>
                                @else
                                    <button type="button" class="btn btn-sm text-white fw-bold"
                                            wire:click="add_or_rm_section_array('po', {{ $key }})"
                                            style="background: #eb5858; width:45%;"><i class="fa fa-minus"></i></button>
                                @endif
                                <button type="button" class="btn btn-sm text-white fw-bold"
                                        wire:click="make_as_lock_or_unlock('po', {{ $key }})"
                                        style="background: #A9A9A9; width:45%;"><i class="fa fa-lock"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="deposit">
                    {{-- <div style="display: flex; justify-content: space-between; width=100%;">
                        <h6 class="fw-bold">Deposit Details</h6>
                        <button type="button" class="btn btn-sm text-white" wire:click="reset_section('deposit')" style="background:#D4D4D4;"><i class="fas fa-sync"></i> Reset </button>
                    </div> --}}
                    @foreach (array_reverse($deposit_section_array, true) as $key => $deposit_section)
                        <div class="row">
                            <div class="col">
                                <div class="form-group @error("deposit_section_array.$key.po_number") has-danger @enderror">
                                    <label class="form-label required">PO Number</label>
                                    <input type="text" class="form-control form-control-sm"
                                           @if($deposit_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="deposit_section_array.{{ $key }}.po_number">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group @error("deposit_section_array.$key.deposit_amount") has-danger @enderror">
                                    <label class="form-label required">Deposit Amount</label>
                                    <input type="number" class="form-control form-control-sm" step="0.001"
                                           @if($deposit_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="deposit_section_array.{{ $key }}.deposit_amount">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group @error("deposit_section_array.$key.deposit_date") has-danger @enderror">
                                    <label class="form-label required">Deposit Date</label>
                                    <input type="date" class="form-control form-control-sm"
                                           @if($deposit_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="deposit_section_array.{{ $key }}.deposit_date">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label required">Deposit Bank</label>
                                    <select class="form-select form-select-sm @error("deposit_section_array.$key.deposit_bank") bg-danger @enderror"
                                            @if($deposit_section_array[$key]['lock'] ?? false) disabled
                                            @endif wire:model="deposit_section_array.{{ $key }}.deposit_bank">
                                        <option value="">Select Deposit Bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">
                                                {{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group @error("deposit_section_array.$key.journal_number") has-danger @enderror">
                                    <label class="form-label required">Journal Number</label>
                                    <input type="text" class="form-control form-control-sm"
                                           @if($deposit_section_array[$key]['lock'] ?? false) disabled
                                           @endif wire:model="deposit_section_array.{{ $key }}.journal_number">
                                </div>
                            </div>


                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label required">Deposit By</label>
                                    <select class="form-select form-select-sm @error("deposit_section_array.$key.deposit_by") bg-danger @enderror" @if($deposit_section_array[$key]['lock'] ?? false) disabled @endif wire:model="deposit_section_array.{{ $key }}.deposit_by">
                            <option value="">Select Deposit by</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}

                            {{-- <div class="col-md-3">
                                        <div class="form-group @error("deposit_section_array.$key.deposit_slip") has-danger @enderror">
                                            <label class="form-label required">Deposit Slip</label>
                                            <input type="text" class="form-control form-control-sm" @if($deposit_section_array[$key]['lock'] ?? false) disabled @endif wire:model="deposit_section_array.{{ $key }}.deposit_slip">
                        </div>
                    </div> --}}

                            <div class="col-md-3 mt-4">
                                @if($loop->first)
                                    <button type="button" class="btn btn-sm text-white fw-bold"
                                            wire:click="add_or_rm_section_array('deposit')"
                                            style="background: #0AADD1; width:45%;"><i class="fa fa-plus"></i></button>
                                @else
                                    <button type="button" class="btn btn-sm text-white fw-bold"
                                            wire:click="add_or_rm_section_array('deposit', {{ $key }})"
                                            style="background: #eb5858; width:45%;"><i class="fa fa-minus"></i></button>
                                @endif
                                <button type="button" class="btn btn-sm text-white fw-bold"
                                        wire:click="make_as_lock_or_unlock('deposit', {{ $key }})"
                                        style="background: #A9A9A9; width:45%;"><i class="fa fa-lock"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class=" mb-5" style=" display: flex; justify-content: space-between; width=100%;">
        <a href="{{ route('payment') }}" class="btn btn-sm text-white fw-bold" style="background: #A9A9A9;  width:45%;">Reset
            All</a>
        {{-- @if((array_sum(array_column($receive_section_array,'receive_amount')) + array_sum(array_column($receive_section_array,'late_fee_receive_amount')) + array_sum(array_column($receive_section_array,'vat_receive_amount')))
                    == array_sum(array_column($po_section_array,'po_amount')) && array_sum(array_column($po_section_array,'po_amount')) == array_sum(array_column($deposit_section_array,'deposit_amount'))) --}}
        <button type="button" class="btn btn-sm text-white fw-bold" style="background: #3BB001;  width:45%;"
                wire:click="submit">Final Submit
        </button>
        {{-- @endif --}}
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <h1 class="text-danger">Error messages:</h1>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
