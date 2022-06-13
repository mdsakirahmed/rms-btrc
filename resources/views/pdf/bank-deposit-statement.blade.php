@extends('layouts.pdf.app')
@section('content')
<h3># Bank Deposit Statement # Deposit Bank: {{ $deposit_bank }}</h3>
<table style="width: 100%;">
    <thead>
        <tr>
            <th>#</th>
            <th>Name of VSP</th>
            <th>Operator</th>
            <th>P.O No</th>
            <th>P.O Date</th>
            <th>Name of Bank</th>
            <th style="text-align: right;">Amount</th>
            <th style="text-align: right;">VAT</th>
            <th style="text-align: right;">TAX</th>
            <th style="text-align: right;">Late Fee</th>
            <th style="text-align: right;">Total PO <sub>(Collection + VAT + Late Fee)</sub> </th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_receive_amount = 0;
        $total_receive_vat_amount = 0;
        $total_receive_tax_amount = 0;
        $total_receive_late_fee_amount = 0;
        $total_po_amount = 0;
        @endphp
        @foreach ($collections as $collection)
        <tr @if($loop->odd) style="background: #F7F4F3" @endif>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $collection->operator->category->name ?? 'Category not found' }}</td>
            <td>{{ $collection->operator->name ?? 'Operator not found' }}</td>
            <td>{{ $collection->po_numbers_as_string() }}</td>
            <td>{{ $collection->po_dates_as_string() }}</td>
            <td>{{ $collection->po_banks_as_string() }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_vat_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_tax_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_late_fee_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_po_amount()) }}</td>
        </tr>
        @php
        $total_receive_amount += $collection->total_receive_amount();
        $total_receive_vat_amount += $collection->total_receive_vat_amount();
        $total_receive_tax_amount += $collection->total_receive_tax_amount();
        $total_receive_late_fee_amount += $collection->total_receive_late_fee_amount();
        $total_po_amount += $collection->total_po_amount();
        @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>Total</th>
            <th style="text-align: right;">{{ money_format_india($total_receive_amount) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_receive_vat_amount) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_receive_tax_amount) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_receive_late_fee_amount) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_po_amount) }}</th>
        </tr>
    </tbody>

</table>
@endsection
