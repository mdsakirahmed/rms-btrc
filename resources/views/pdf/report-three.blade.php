@extends('layouts.pdf.app')
@section('content')
<h5># Bank Deposit Statement # Deposit Bank: {{ $po_bank }} # Category: {{ $category }}</h5>
<table style="width: 100%;" class="table" cellpading="0" cellspacing="0">

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
@endsection
