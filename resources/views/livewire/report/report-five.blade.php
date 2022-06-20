<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Statement</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Statement</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <button class="btn btn-success" wire:click="export_as_excel">Export as .xlsx</button> --}}
                    <button class="btn btn-success" wire:click="export_as_pdf">Export as .pdf</button>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('category') border-danger @endif"
                                    wire:model="category" title="Category" wire:change="change_category_and_sub_category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('category') border-danger @endif"
                                    wire:model="sub_category" title="Sub Category" wire:change="change_category_and_sub_category">
                                <option value="">Select Sub Categories</option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('operator') border-danger @endif"
                                    wire:model="operator" title="Operator">
                                <option value="">Select Operator</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($operator_model)
                        <div class="table-responsive">
                            <table class="table datatable color-table primary-table" style="white-space: nowrap;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Particulars</th>
                                    <th>Period</th>
                                    <th style="text-align: right;">Receivable</th>
                                    <th>Due Date of Payment</th>
                                    <th>Receive Date</th>
                                    <th>No. of Delay Days</th>
                                    <th style="text-align: right;">Late Fee</th>
                                    <th style="text-align: right;">VAT</th>
                                    <th style="text-align: right;">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($operator_model->category->category_wise_fees as $fee_type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fee_type->fee_type->name }}</td>
                                        <td>
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ $period->period_label }} <br>
                                            @endforeach
                                            <br> <b style="border: 2px solid green; padding: 3%;">{{ $loop->iteration }}. Sub-Total</b>
                                        </td>
                                        <td style="text-align: right;">
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ money_format_india($period->total_receivable) }} <br>
                                            @endforeach
                                                <br> <b style="border: 2px solid green; padding: 3%;">{{ money_format_india($operator_model->fee_type_wise_periods($fee_type->fee_type_id)->sum('total_receivable')) }}</b>
                                        </td>
                                        <td>
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ $period->period_schedule_date->format('d/m/Y') }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ date('d/m/Y') }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)) }}
                                                <br>
                                            @endforeach
                                        </td>
                                        <td style="text-align: right;">
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ money_format_india(round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                                                <br>
                                            @endforeach
                                                <br> <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->late_fee_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                                        </td>
                                        <td style="text-align: right;">
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ money_format_india(round(($period->total_receivable / 100) * $fee_type->vat)) }}
                                                <br>
                                            @endforeach
                                                <br> <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->vat_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                                        </td>
                                        <td style="text-align: right;">
                                            @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                                                {{ money_format_india($period->total_receivable + round(($period->total_receivable / 100) * $fee_type->vat) + round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                                                <br>
                                            @endforeach
                                                <br> <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->sum_of_receivable_vat_late_fee_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger text-center" role="alert">
                            <h3>Operator is Not Selected</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
