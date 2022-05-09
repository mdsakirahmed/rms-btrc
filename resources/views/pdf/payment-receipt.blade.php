@extends('layouts.pdf.app')
@section('content')
    <style>
        .pdf_content table {
            width: 100%;
            border-collapse: collapse;
        }

        .pdf_content table, .pdf_content th, .pdf_content td {
            border: 1px solid;
        }
    </style>
    <div class="pdf_content" style="width: 100%;">
        <h1>Payment</h1>
        <h5>Transaction number: {{ $payment->transaction }}</h5>
        <h5>Category: {{ $payment->operator->name ?? 'Not found' }}</h5>
        <h5>Sub Category: {{ $payment->operator->category->name ?? 'Not found' }}</h5>
        <h5>Operator : {{ $payment->operator->sub_category->name ?? 'Not found' }}</h5>
        <br>
        <h3>Receive amount</h3>
        <table>
            <tr>
                <th>Type</th>
                <th>Period</th>
                <th>Schedule Date</th>
                <th>Receive Date</th>
                <th>Receive Amount</th>
                <th>Late</th>
                <th>VAT</th>
                <th>TAX</th>
            </tr>
            @foreach ($payment->receives as $receive)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $receive->fee_type->name ?? 'Not Found' }}</td>
                    <td>{{ $receive->period_end_date }}</td>
                    <td>{{ $receive->receive_date }}</td>
                    <td>{{ $receive->receive_amount }}</td>
                    <td>{{ round($receive->late_fee_amount) }}</td>
                    <td>{{ round(($receive->vat_percentage/100) * $receive->receive_amount) }}</td>
                    <td>{{ round(($receive->tax_percentage/100) * $receive->receive_amount) }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <h3>Pay order</h3>
        <table>
            <tr>
                <th>PO Amount</th>
                <th>PO Number</th>
                <th>PO Date</th>
                <th>PO Bank</th>
            </tr>
            @foreach($payment->pay_orders as $pay_order)
            <tr>
                <td>{{ $pay_order->amount }}</td>
                <td>{{ $pay_order->number }}</td>
                <td>{{ $pay_order->date }}</td>
                <td>{{ $pay_order->bank->name ?? 'Not Found' }}</td>
            </tr>
            @endforeach
        </table>
        <br>
        <h3>Deposit</h3>
        <table>
            <tr>
                <th>Deposit Amount</th>
                <th>Deposit Journal No</th>
                <th>Deposit Date</th>
                <th>Deposit Bank</th>
            </tr>
            @foreach($payment->deposits as $deposit)
                <tr>
                    <td>{{ $deposit->amount }}</td>
                    <td>{{ $deposit->journal_number }}</td>
                    <td>{{ $deposit->date }}</td>
                    <td>{{ $deposit->bank->name ?? 'Not Found' }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
