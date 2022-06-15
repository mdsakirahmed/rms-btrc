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
                            <select name="" id="" class="form-control @error('po_bank') border-danger @endif" wire:model="po_bank" title="PO Bank">
                                <option value="">All Bank</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('category') border-danger @endif" wire:model="category" title="License Category">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company Name</th>
                                    {{-- <th>Category</th> --}}
                                    <th>P.O SL</th>
                                    <th>Name of Bank</th>
                                    <th>PO Number</th>
                                    <th>PO Date</th>
                                    <th>Total Amount</th>
                                    <th>Spectrum Charge</th>
                                    <th>Spectrum VAT</th>
                                    <th>Late Fee</th>
                                    <th>Year</th>
                                    <th>Demand Note Issue Date</th>
                                    <th>Receive Date</th>
                                    <th>Journal Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pay_orders as $po)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $po->payment->operator->name ?? 'Operator Not Found' }}</td>
                                    {{-- <td>{{ $po->payment->operator->category->name ?? 'Category Not Found' }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $po->bank->name ?? 'Bank Not Found' }}</td>
                                    <td>{{ $po->number ?? 'PO Number Not Found' }}</td>
                                    <td>{{ $po->date->format('d-m-Y') ?? 'PO Date Not Found' }}</td>
                                    <td style="text-align: right">{{ money_format_india($po->amount) }}</td>
                                    <td style="text-align: right">{{ money_format_india($po->payment->total_receive_spectrum_amount()) }}</td>
                                    <td style="text-align: right">{{ money_format_india($po->payment->total_receive_spectrum_vat_amount()) }}</td>
                                    <td style="text-align: right">{{ money_format_india($po->payment->total_receive_late_fee_amount()) }}</td>
                                    <td>{{ $po->payment->receive_years_as_string() }}</td>
                                    <td>{{ $po->payment->receive_schedule_dates_as_string() }}</td>
                                    <td>{{ $po->payment->receive_dates_as_string() }}</td>
                                    <td>{{ $po->journal->journal_number ?? 'Journal Number Not Found' }}</td>
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
