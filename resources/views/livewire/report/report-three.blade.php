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
                                    <th>S/N</th>
                                    <th>Operator's Name</th>
                                    <th>Receive Date</th>
                                    <th>Pay-Order Amount</th>
                                    <th>Name of the Bank</th>
                                    <th>P.O no.</th>
                                    <th>P.O date</th>
                                    <th>Deposit Bank</th>
                                    <th>Deposit Date</th>
                                    <th>Journal Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pay_orders as $po)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $po->payment->operator->name ?? 'Operator Not Found' }}</td>
                                    <td>{{ $po->payment->receives()->first()->receive_date->format('d-m-Y') ?? 'Bank Not Found' }}</td>
                                    <td style="text-align: right">{{ money_format_india($po->amount) }}</td>
                                    <td>{{ $po->bank->name ?? 'PO Bank Not Found' }}</td>
                                    <td>{{ $po->number ?? 'PO Number Not Found' }}</td>
                                    <td>{{ $po->date->format('d-m-Y') ?? 'PO Date Not Found' }}</td>
                                    <td>{{ $po->deposit->bank->name ?? 'Deposit Bank Not Found' }}</td>
                                    <td> @if($po->deposit){{ date('d-n-Y', strtotime($po->deposit->date)) ?? 'Deposit Date Not Found' }} @endif</td>
                                    <td>{{ $po->deposit->journal_number ?? 'Journal Number Not Found' }}</td>
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
