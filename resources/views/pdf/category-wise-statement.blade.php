@extends('layouts.pdf.app')
@section('content')
<h3># Bank Deposit Statement # Deposit Bank: {{ $deposit_bank }} # Category: {{ $category }}</h3>
<table style="width: 100%;" class="table" cellpading="0" cellspacing="0">
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
        @php
        $total_receive_amount = 0;
        $total_receive_spectrum_amount = 0;
        $total_receive_vat_amount = 0;
        $total_receive_tax_amount = 0;
        $total_receive_late_fee_amount = 0;
        // $total_po_amount = 0;
        @endphp
        @foreach ($collections as $collection)
        <tr @if($loop->odd) style="background: #F7F4F3" @endif>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $collection->operator->name ?? 'Operator not found' }}</td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $collection->po_banks_as_string() }}</td>
            <td>{{ $collection->po_numbers_as_string() }}</td>
            <td>{{ $collection->po_dates_as_string() }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_amount() -  $collection->total_receive_spectrum_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_spectrum_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_vat_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_tax_amount()) }}</td>
            <td style="text-align: right;">{{ money_format_india($collection->total_receive_late_fee_amount()) }}</td>
            {{-- <td style="text-align: right;">{{ money_format_india($collection->total_po_amount()) }}</td> --}}
            <td>{{ $collection->receive_years_as_string() }}</td>
            <td>{{ $collection->receive_schedule_dates_as_string() }}</td>
            <td>{{ $collection->receive_dates_as_string() }}</td>
        </tr>
        @php
        $total_receive_amount += $collection->total_receive_amount() - $collection->total_receive_spectrum_amount();
        $total_receive_spectrum_amount += $collection->total_receive_spectrum_amount();
        $total_receive_vat_amount += $collection->total_receive_vat_amount();
        $total_receive_tax_amount += $collection->total_receive_tax_amount();
        $total_receive_late_fee_amount += $collection->total_receive_late_fee_amount();
        // $total_po_amount += $collection->total_po_amount();
        @endphp
        @endforeach
        <tr>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td style="text-align: right;">{{ money_format_india($total_receive_amount) }}</td>
            <td style="text-align: right;">{{ money_format_india($total_receive_spectrum_amount) }}</td>
            <td style="text-align: right;">{{ money_format_india($total_receive_vat_amount) }}</td>
            <td style="text-align: right;">{{ money_format_india($total_receive_tax_amount) }}</td>
            <td style="text-align: right;">{{ money_format_india($total_receive_late_fee_amount) }}</td>
            {{-- <th style="text-align: right;">{{ money_format_india($total_po_amount) }}</th> --}}
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>

</table>
@endsection
