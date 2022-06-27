@extends('layouts.pdf.app')
@section('content')
<h5># Bank Deposit Statement # Deposit Bank: {{ $po_bank }} # Category: {{ $category }}</h5>
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
            {{-- @foreach ($fee_types as $fee_type)
                <th>{{ $fee_type->fee_type->name ?? '' }}</th>
                <th>{{ $fee_type->fee_type->name ?? '' }} Late Fee {{ $fee_type->late_fee ?? '' }} %</th>
                <th>{{ $fee_type->fee_type->name ?? '' }} VAT {{ $fee_type->vat ?? '' }} %</th>
            @endforeach --}}
            <th>Total Receive</th>
            <th>Total Late Fee</th>
            <th>Total VAT</th>
            <th>Total Amount</th>
            <th>Year</th>
            <th>Demand Note Issue Date</th>
            <th>Receive Date</th>
            <th>Deposit Date</th>
            <th>Deposit Bank</th>
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
            {{-- @foreach ($fee_types as $fee_type)
            <td>{{ $po->payment->total_receive_amount_by_category($fee_type->fee_type_id) }}</td>
            <td>{{ $po->payment->total_receive_late_fee_amount_by_category($fee_type->fee_type_id) }}</td>
            <td>{{ $po->payment->total_receive_vat_amount_by_category($fee_type->fee_type_id) }}</td>
            @endforeach --}}
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_amount()) }}</td>
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_late_fee_amount()) }}</td>
            <td style="text-align: right">{{ money_format_india($po->payment->total_receive_vat_amount()) }}</td>
            <td style="text-align: right">{{ money_format_india($po->amount) }}</td>
            <td>{{ $po->payment->receive_years_as_string() }}</td>
            <td>{{ $po->payment->receive_schedule_dates_as_string() }}</td>
            <td>{{ $po->payment->receive_dates_as_string() }}</td>
            <td> @if($po->deposit){{ date('d-n-Y', strtotime($po->deposit->date)) ?? 'Deposit Date Not Found' }} @endif</td>
            <td>{{ $po->deposit->bank->name ?? 'Deposit Bank Not Found' }}</td>
            <td>{{ $po->deposit->journal_number ?? 'Journal Number Not Found' }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
