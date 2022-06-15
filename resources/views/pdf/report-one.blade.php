@extends('layouts.pdf.app')
@section('content')
<h3># Bank Deposit Statement # Deposit Bank: {{ $deposit_bank }}</h3>
<table style="width: 100%;" class="table" cellpading="0" cellspacing="0">
    <thead>
        <tr>
            <th>SL</th>
            <th>Operator Name</th>
            <th>Category</th>
            <th>Journal Number</th>
            <th>Deposit Date</th>
            <th>PO Bank</th>
            <th>PO Number</th>
            <th>PO Date</th>
            <th style="text-align: right">Amount</th>
            <th>Deposit Bank</th>
            {{-- <th>Comment</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($deposits as $deposit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $deposit->payment->operator->name ?? 'Operator Not Found' }}</td>
            <td>{{ $deposit->payment->operator->category->name ?? 'Category Not Found' }}</td>
            <td>{{ $deposit->journal_number }}</td>
            <td>{{ $deposit->date }}</td>
            <td>{{ $deposit->po->bank->name ?? 'Bank Not Found' }}</td>
            <td>{{ $deposit->po->number ?? 'PO Number Not Found' }}</td>
            <td>{{ $deposit->po->date ?? 'PO Date Not Found' }}</td>
            <td style="text-align: right">{{ money_format_india($deposit->amount) }}</td>
            <td>{{ $deposit->bank->name ?? 'Bank Not Found' }}</td>
            {{-- <td> --Comment-- </td> --}}
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
