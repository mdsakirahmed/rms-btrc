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
                    <div wire:loading>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
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
                @if($receive_section_done)
                <button type="button" class="btn btn-info w-100 mt-4 cln_btn" wire:click="receive_make_as_done(0)">Receive Section <i class="fa fa-pen"></i></button>
                <div class="row m-3">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-primary text-center">
                                <h1 class="font-light text-white">{{ array_sum(array_column($receive_section_array,'receive_amount')) }}</h1>
                                <h6 class="text-white">Total receive amount</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        
                    </div>
                </div>
                @else
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
                            <x-error name="receive_section_array.{{ $key }}.selected_fee_type"/>
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
                            <x-error name="receive_section_array.{{ $key }}.selected_period"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label">Schedule Date</label>
                            <input type="text" class="form-control mt-1" disabled wire:model="receive_section_array.{{ $key }}.schedule_date">
                            <x-error name="receive_section_array.{{ $key }}.schedule_date"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="form-label required">Receive Date</label>
                            <input type="date" class="form-control" wire:change="receive_date_change({{ $key }}, $event.target.value)">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required">Receivable</label>
                            <input type="number" class="form-control" disabled wire:model="receive_section_array.{{ $key }}.receivable">
                            <x-error name="receive_section_array.{{ $key }}.receivable"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required">Receive</label>
                            <input type="number" class="form-control" step="0.001" wire:model="receive_section_array.{{ $key }}.receive_amount" wire:change="receive_amount_change({{ $key }}, $event.target.value)">
                            <x-error name="receive_section_array.{{ $key }}.receive_amount"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required">
                                Late Fee( <b class="text-success late_fee_title">@isset($receive_section_array[$key]['late_fee_percentage']) {{ $receive_section_array[$key]['late_fee_percentage'] ?? 0 }} @endisset </b>%
                                @isset($receive_section_array[$key]['late_days']) for {{ $receive_section_array[$key]['late_days'] }} days @endisset)
                            </label>
                            <input type="number" class="form-control" step="0.001" wire:model="receive_section_array.{{ $key }}.late_fee_receive_amount">
                            <x-error name="receive_section_array.{{ $key }}.late_fee_receive_amount"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required">VAT (<b class="text-success vat_title">@isset($receive_section_array[$key]['vat_percentage']) {{ $receive_section_array[$key]['vat_percentage'] ?? 0 }} @endisset</b>%)</label>
                            <input type="number" class="form-control" step="0.001" disabled wire:model="receive_section_array.{{ $key }}.vat_receive_amount">
                            <x-error name="receive_section_array.{{ $key }}.vat_receive_amount"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-success">
                            <label class="form-label required">TAX (<b class="text-success tax_title">@isset($receive_section_array[$key]['tax_percentage']) {{ $receive_section_array[$key]['tax_percentage'] ?? 0 }} @endisset</b>%)</label>
                            <input type="number" class="form-control" step="0.001" disabled wire:model="receive_section_array.{{ $key }}.tax_receive_amount">
                            <x-error name="receive_section_array.{{ $key }}.tax_receive_amount"/>                        
                        </div>
                    </div>
                    <div class="col-2 mt-2">
                        <button type="button" class="btn btn-warning w-100 mt-4 cln_btn" title="Remove this one" wire:click="add_or_rm_section_array('receive', {{ $key }})"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                @endforeach
                <button type="button" class="btn btn-info w-100 mt-4 cln_btn" title="Add new one" wire:click="add_or_rm_section_array('receive')"><i class="fa fa-plus"></i></button>
                @if(count($receive_section_array) > 0)
                <button type="button" class="btn btn-info w-100 mt-4 cln_btn" wire:click="receive_make_as_done(1)"> Receive Section <i class="fa fa-check"></i></button>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
