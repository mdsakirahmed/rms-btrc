<div>
    <style>
        table {
            white-space: nowrap;
        }
    </style>
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
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('deposit_bank') border-danger @endif" wire:model="deposit_bank" title="Deposit Bank">
                                <option value="">All bank</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('category') border-danger @endif" wire:model="category" title="Operatop Ctegory">
                                <option value="">All category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company Name</th>
                                    <th>P.O SL</th>
                                    <th>Name of Bank</th>
                                    <th>P.O No</th>
                                    <th>P.O Date</th>
                                    <th style="text-align: right;">Amount</th>
                                    <th style="text-align: right;">Spectrum Charge</th>
                                    <th style="text-align: right;">VAT</th>
                                    <th style="text-align: right;">TAX</th>
                                    <th style="text-align: right;">Late Fee</th>
                                    {{-- <th style="text-align: right;">Total PO <br> <sub>(Collection + Spectrum Charge + VAT + Late Fee)</sub> </th> --}}
                                    <th>Year</th>
                                    <th>Demand Note Issue Date</th>
                                    <th>Received Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statements as $statement)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $statement->operator->name ?? 'Operator not found' }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $statement->po_banks_as_string() }}</td>
                                    <td>{{ $statement->po_numbers_as_string() }}</td>
                                    <td>{{ $statement->po_dates_as_string() }}</td>
                                    <td style="text-align: right;">{{ money_format_india($statement->total_receive_amount() -  $statement->total_receive_spectrum_amount()) }}</td>
                                    <td style="text-align: right;">{{  money_format_india($statement->total_receive_spectrum_amount()) }}</td>
                                    <td style="text-align: right;">{{ money_format_india($statement->total_receive_vat_amount()) }}</td>
                                    <td style="text-align: right;">{{ money_format_india($statement->total_receive_tax_amount()) }}</td>
                                    <td style="text-align: right;">{{ money_format_india($statement->total_receive_late_fee_amount()) }}</td>
                                    {{-- <td style="text-align: right;">{{ money_format_india($statement->total_po_amount()) }}</td> --}}
                                    <td>{{ $statement->receive_years_as_string() }}</td>
                                    <td>{{ $statement->receive_schedule_dates_as_string() }}</td>
                                    <td>{{ $statement->receive_dates_as_string() }}</td>
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
