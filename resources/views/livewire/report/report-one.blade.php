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
                        {{-- <div class="col-3">
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
                    </div> --}}
                </div>
                <div class="table-responsive">
                    <table class="table datatable color-table primary-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Operator Name</th>
                                <th>Category</th>
                                <th>Joutnal Number</th>
                                <th>Deposit Date</th>
                                <th>PO Bank</th>
                                <th>PO Number</th>
                                <th>PO Date</th>
                                <th style="text-align: right">Amount</th>
                                <th>Deposit Bank</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $deposit->payment->operator->name ?? 'Operator Not Found' }}</td>
                                <td>{{ $deposit->payment->operator->category->name ?? 'Category Not Found' }}</td>
                                <td>{{ $deposit->journal_number }}</td>
                                <td>{{ $deposit->date }}</td>
                                <td>{{ $deposit->po->bank->name ?? 'Bank Not Found' }}</td>
                                <td>{{ $deposit->po->number ?? 'PO Number Not Found' }}</td>
                                <td>{{ $deposit->po->date ?? 'PO Date Not Found' }}</td>
                                <td style="text-align: right">{{ money_format_india($deposit->amount) }}</td>
                                <td>{{ $deposit->bank->name ?? 'Bank Not Found' }}</td>
                                <td> --Comment-- </td>
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
