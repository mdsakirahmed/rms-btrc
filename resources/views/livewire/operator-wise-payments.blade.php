<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Operator wise payments</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Operator wise payments</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($operator->payments as $payment)
        <div class="col-12" title="Transaction number: {{ $payment->transaction }}">
            <div class="card">
                <div class="card-header">
                    <h1>#{{ $payment->transaction }}</h1>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Recives</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee type</th>
                                    <th>Period date</th>
                                    <th>Receive date</th>
                                    <th>Receive amount</th>
                                    <th>Late Fee</th>
                                    <th>VAT %</th>
                                    <th>TAX %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment->receives as $receive)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $receive->fee_type->name ?? 'Not Found' }}</td>
                                    <td>{{ date('d-m-Y', strtotime($receive->period_end_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($receive->receive_date)) }}</td>
                                    <td>{{ $receive->receive_amount }}</td>
                                    <td>{{ $receive->late_fee_receive_amount }}</td>
                                    <td>{{ $receive->vat_percentage }}</td>
                                    <td>{{ $receive->tax_percentage }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="card-title">Pay orders</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bank</th>
                                    <th>PO Amount</th>
                                    <th>PO Number</th>
                                    <th>PO Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment->pay_orders as $pay_order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pay_order->bank->name ?? 'Not Found' }}</td>
                                    <td>{{ $pay_order->amount }}</td>
                                    <td>{{ $pay_order->number }}</td>
                                    <td>{{ date('d-m-Y', strtotime($pay_order->date)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="card-title">Deposits</h4>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bank</th>
                                    <th>Journal number</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment->deposits as $deposit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $deposit->bank->name ?? 'Not Found' }}</td>
                                    <td>{{ $deposit->journal_number }}</td>
                                    <td>{{ date('d-m-Y', strtotime($deposit->date)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>