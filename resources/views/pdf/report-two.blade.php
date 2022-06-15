@extends('layouts.pdf.app')
@section('content')
<h3># Bank Deposit Statement # Deposit Bank: {{ $po_bank }}</h3>
<table style="width: 100%;" class="table" cellpading="0" cellspacing="0">

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
            <td>{{ date('d-n-Y', strtotime($po->date)) }}</td>
            <td style="text-align: right">{{ money_format_india($po->amount) }}</td>
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_spectrum_amount()) }}</td>
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_spectrum_vat_amount()) }}</td>
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_late_fee_amount()) }}</td>
            <td>{{ $po->payment->receive_years_as_string() }}</td>
            <td>{{ $po->payment->receive_schedule_dates_as_string() }}</td>
            <td>{{ $po->payment->receive_dates_as_string() }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
