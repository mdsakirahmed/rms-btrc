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
                <div class="card-header bg-info text-white">
                    <h4>Payment 2nd design</h4>
                </div>
                <div class="card-body row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label required">Transaction Number</label>
                            <input type="text" class="form-control" value="{{ $transaction }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required" for="sub_category">Sub-Category</label>
                            <select class="form-control form-select select2 filter sub_category" id="sub_category" name="sub_category" wire:model="selected_sub_category">
                                <option value="">Select Sub Category</option>
                                @foreach ($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">
                                    {{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-top: 6px;">
                        <button type="submit" class="btn waves-effect waves-light w-100 btn-info mt-4">Search
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                @foreach ($receive_section_array as $key => $receive_section)
                <div class="card-body row">
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label required" for="fee_type">Fee Type</label>
                            <select class="form-control form-select" wire:model="receive_section_array.{{ $key }}.selected_fee_type" wire:change="fee_type_change({{ $key }})">
                                <option value="">Select Fee Type</option>
                                @foreach ($fee_types as $fee_type)
                                <option value="{{ $fee_type->id }}">
                                    {{ $fee_type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label required">Select Period</label>
                            <select class="form-control form-select" wire:model="receive_section_array.{{ $key }}.selected_period" wire:change="period_change({{ $key }})">
                                <option value="">Select Period</option>
                                @foreach ($periods as $period)
                                <option value="{{ $period->id }}">
                                    {{ $period->period_label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label" for="">Schedule Date</label>
                            <input type="text" class="form-control mt-1" disabled wire:model="receive_section_array.{{ $key }}.schedule_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label required" for="">Receive Date</label>
                            <input type="date" class="form-control receive_date auto_fill_late_fee_amount" id="" name="receive_date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-success">
                            <label class="form-label required" for="">Receive Amount ( <b class="text-success receive_amount_title">--</b> )</label>
                            <input type="number" class="form-control receive_amount auto_fill_late_fee_amount" id="" name="receive_amount" step="0.001">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required" for="">Late ( <b class="text-success late_fee_title">--</b>%)</label>
                            <input type="number" class="form-control late_fee_receive" id="" name="late_fee_receive" step="0.001">
                            <input type="hidden" class="differ_from_period_day_hidden">
                            <input type="hidden" class="late_fee_amount_of_due_days_hidden">
                            <p class="text-danger late_fee_help_line"></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required" for="">VAT (<b class="text-success vat_title">--</b>%)</label>
                            <input type="number" class="form-control vat" id="" name="vat" step="0.001" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required" for="">TAX (<b class="text-success tax_title">--</b>%)</label>
                            <input type="number" class="form-control tax" id="" name="tax" step="0.001" disabled>
                            <p class="text-danger tax_help_line"></p>
                        </div>
                    </div>
                    <div class="col-2 cln__or_rm_div">
                        <button type="button" class="btn btn-warning w-100 mt-4 cln_btn" title="Remove this one" wire:click="add_or_rm_section_array('receive', {{ $key }})"><i class="fa fa-minus"></i></button>
                    </div>
                    <div class="col-12 d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight fw-bold">Total Receive Amount Is: <b id="total_amount_of_receive">0</b> BDT
                        </div>
                    </div>
                </div>
                @endforeach
                <button type="button" class="btn btn-info w-100 mt-4 cln_btn" title="Add new one" wire:click="add_or_rm_section_array('receive')"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>
