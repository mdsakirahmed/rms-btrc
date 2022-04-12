<div wire:ignore>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Operator wise file register</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Operator wise file register</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"># Payments</h4>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table" style="font-size: 8px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receive date</th>
                                    <th>Operator</th>
                                    <th>Particular</th>
                                    <th>Period</th>
                                    <th>Fee</th>
                                    <th>VAT</th>
                                    <th>Late Fee</th>
                                    <th>Receive total</th>
                                    <th>PO Bank</th>
                                    <th>PO NO</th>
                                    <th>PO Date</th>
                                    <th>Deposit Journal</th>
                                    <th>Deposit Bank</th>
                                    <th>Deposit Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->receive_date }}</td>
                                        <td>{{ $payment->operator_name }}</td>
                                        <td>{{ $payment->fee_type_name }}</td>
                                        <td>{{ $payment->period_date }}</td>
                                        <td>{{ $payment->receive_amount }}</td>
                                        <td>{{ $payment->receive_vat }}</td>
                                        <td>{{ $payment->receive_late_fee }}</td>
                                        <td>Total need work</td>
                                        <td>{{ $payment->po_bank_name }}</td>
                                        <td>{{ $payment->po_number }}</td>
                                        <td>{{ $payment->po_date }}</td>
                                        <td>{{ $payment->deposit_journal_number }}</td>
                                        <td>{{ $payment->deposit_bank_name }}</td>
                                        <td>{{ $payment->deposit_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                // dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Copy to clipboard'
                    },
                    'excel',
                    'pdf'
                ]
            });
        });
    </script>
</div>
