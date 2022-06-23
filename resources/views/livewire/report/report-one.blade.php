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
                            <input type="date" class="form-control @error('starting_date') border-danger @endif" wire:model="starting_date" title="Deposit Starting Date">
                        </div>
                        <div class="col-4">
                            <input type="date" class="form-control @error('ending_date') border-danger @endif" wire:model="ending_date" title="Deposit Ending Date">
                        </div>
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('deposit_bank') border-danger @endif" wire:model="deposit_bank" title="Deposit Bank">
                                <option value="">All Bank</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Operator Name</th>
                                    <th>Category</th>
                                    <th>Journal Number</th>
                                    <th>Deposit Date</th>
                                    <th>PO Bank</th>
                                    <th>PO Number</th>
                                    <th>PO Date</th>
                                    <th style="text-align: right">Amount</th>
                                    <th>Deposit Bank</th>
                                    {{-- <th>Comment</th> --}}
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
                                    {{-- <td> --Comment-- </td> --}}
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
