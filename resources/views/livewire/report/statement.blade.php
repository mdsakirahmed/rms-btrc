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
                    <button class="btn btn-success" wire:click="export_as_excel">Export as .xlsx</button>
                    <button class="btn btn-success" wire:click="export_as_pdf">Export as .pdf</button>
                </div>
                <div class="card-body">

                    <div class="row mb-5">
                        <div class="col-3">
                            <select name="" id="" class="form-control" wire:model="selected_fee_type">
                                <option value="">Select Fee Type</option>
                                @foreach ($fee_types as $fee_type)
                                    <option value="{{ $fee_type->id }}">{{ $fee_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="" id="" class="form-control" wire:model="selected_period">
                                <option value="">Select Period</option>
                                @foreach ($periods as $period)
                                    <option value="{{ $period }}">{{ $period }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Operator</th>
                                    <th style="text-align: right">Receivable</th>
                                    <th style="text-align: right">Receive</th>
                                    <th style="text-align: right">Outstanding</th>
                                    <th style="text-align: right">Previous Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th>#</th>
                                    <th><input wire:model="category_name" type="text" class="form-control" placeholder="Operator"></th>
                                    <th><input style="text-align: right" wire:model="sub_category_name" type="text" class="form-control" placeholder="Receivable"></th>
                                    <th><input style="text-align: right" wire:model="operator_name" type="text" class="form-control" placeholder="Receive"></th>
                                    <th><input style="text-align: right" wire:model="receive_date" type="text" class="form-control" placeholder="Outstanding"></th>
                                </tr> --}}
                                @foreach ($exp_wise_payment_dates as $exp_wise_payment_date)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exp_wise_payment_date->expiration->operator->name ?? 'Not found' }}</td>
                                        <td style="text-align: right">{{ money_format_india($exp_wise_payment_date->total_receivable) }}</td>
                                        <td style="text-align: right">{{ money_format_india($exp_wise_payment_date->total_paid_amount()) }}</td>
                                        <td style="text-align: right">{{ money_format_india($exp_wise_payment_date->total_due_amount()) }}</td>
                                        <td style="text-align: right">{{ money_format_india($exp_wise_payment_date->expiration->fee_type_wise_total_due_amount($selected_fee_type)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
