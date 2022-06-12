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
                            <select name="" id="" class="form-control @error('category') border-danger @endif" wire:model="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="date" name="" id="" class="form-control @error('starting_date') border-danger @endif" wire:model="starting_date">
                        </div>
                        <div class="col-3">
                            <input type="date" name="" id="" class="form-control @error('ending_date') border-danger @endif" wire:model="ending_date">
                        </div>
                        <button class="btn btn-success col-2 text-white" type="button" wire:click="generate">Generate</button>
                    </div>
                    <div class="table-responsive">
                        {{-- <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Operator</th>
                                    <th>Expiration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operators as $operator)
                                @if($operator->expirations->count() > 0)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                        <td>{{ $operator->name ?? 'Operator Not found' }}</td>
                        <td>

                            <table class="table color-table secondary-table">
                                <thead>
                                    <tr>
                                        <th> Period </th>
                                        <th> Payments </th>
                                    </tr>
                                </thead>
                                @foreach($operator->expirations as $expiration)
                                <tr>
                                    <td> {{ $expiration->issue_date->format('d M Y') }} - {{ $expiration->expire_date->format('d M Y') }} </td>
                                    <td>
                                        @if($expiration->payments->count() > 0)
                                        <table class="table secondary-table">
                                            <thead>
                                                <tr>
                                                    <th> Transaction </th>
                                                    <th> Collections </th>
                                                    <th> PO </th>
                                                    <th> Deposit </th>
                                                </tr>
                                            </thead>
                                            @foreach($expiration->payments as $payment)
                                            <tr>
                                                <td> {{ $payment->transaction }} </td>
                                                <td>
                                                    @if($payment->receives->count() > 0)
                                                    <table class="table color-table">
                                                        <thead>
                                                            <tr>
                                                                <th> Fee Type </th>
                                                                <th> Period </th>
                                                                <th> Schedule Date </th>
                                                                <th> Collection Date </th>
                                                                <th> Collactable Amount </th>
                                                                <th> Collection Amount </th>
                                                                <th> Due Amount </th>
                                                                <th> VAT Amount </th>
                                                                <th> TAX Amount </th>
                                                            </tr>
                                                        </thead>
                                                        @foreach($payment->receives as $receive)
                                                        <tr>
                                                            <td> {{ $receive->period_id }} </td>
                                                            <td> {{ $receive->period_id }} </td>
                                                            <td> {{ $receive->period_id }} </td>
                                                            <td> {{ $receive->receive_date }} </td>
                                                            <td> {{ $receive->period_id }} </td>
                                                            <td> {{ $receive->receive_amount }} </td>
                                                            <td> {{ $receive->late_fee_receive_amount }} </td>
                                                            <td> {{ $receive->vat_percentage }} </td>
                                                            <td> {{ $receive->tax_percentage }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($payment->pay_orders->count() > 0)
                                                    <table class="table color-table">
                                                        <thead>
                                                            <tr>
                                                                <th> PO Amount </th>
                                                                <th> PO Number </th>
                                                                <th> PO Date </th>
                                                                <th> PO Bank </th>
                                                            </tr>
                                                        </thead>
                                                        @foreach($payment->pay_orders as $pay_order)
                                                        <tr>
                                                            <td> {{ $pay_order->amount }} </td>
                                                            <td> {{ $pay_order->number }} </td>
                                                            <td> {{ $pay_order->date }} </td>
                                                            <td> {{ $pay_order->bank_id }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($payment->deposits->count() > 0)
                                                    <table class="table color-table">
                                                        <thead>
                                                            <tr>
                                                                <th> Deposit Amount </th>
                                                                <th> Journal Number </th>
                                                                <th> Deposit Date </th>
                                                                <th> Deposit Bank </th>
                                                            </tr>
                                                        </thead>
                                                        @foreach($payment->deposits as $deposit)
                                                        <tr>
                                                            <td> {{ $deposit->amount }} </td>
                                                            <td> {{ $deposit->journal_number }} </td>
                                                            <td> {{ $deposit->date }} </td>
                                                            <td> {{ $deposit->bank_id }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                        </table> --}}
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Operator</th>
                                    <th>PO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_sets as $operator_id => $data_set)
                                {{-- @dd($data_set) --}}
                                {{--
                                    +"category_name": "2G Cellular Mobile Telecom Operator"
  +"operator_id": 378
  +"operator_name": "Rickie Herzog"
  +"expiration_id": 7
  +"payment_id": 13
  +"transaction_number": "2206-A-00013"
  +"receive_id": 12
  +"po_id": 3
  +"deposit_id": 3
  +"po_bank_id": 2
  +"deposit_bank_id": 3
                                    --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data_set[0]->operator_name }}</td>
                                    <td>
                                        @foreach ($data_set as $data)
                                            {{ $data->po_id }},
                                        @endforeach
                                        {{-- {{ $data_set[0]->payment_id }} --}}
                                    </td>
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
