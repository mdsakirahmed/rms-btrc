@extends('layouts.pdf.app')
@section('content')
    <h3>Deposit Bank: {{ $deposit_bank }}</h3>
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
            @endforeach
        </tbody>
    </table>
@endsection
