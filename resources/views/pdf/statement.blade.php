@extends('layouts.pdf.app')
@section('content')

    <table style="width: 100%;">
        <thead>
            <tr style="background: #f5f5f5">
                <th scope="col">#</th>
                <th scope="col"> Operator </th>
                <th scope="col" style="text-align: right"> Receivable </th>
                <th scope="col" style="text-align: right"> Receive </th>
                <th scope="col" style="text-align: right"> Outstanding </th>
                <th scope="col" style="text-align: right"> Previous Due </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_receivable = 0;
                $total_paid_amount = 0;
                $total_due_amount = 0;
                $fee_type_wise_total_due_amount = 0;
            @endphp
            @foreach ($collections as $collection)
                <tr @if($loop->even) style="background: #f1f1f1" @endif>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $collection->expiration->operator->name ?? 'Not found' }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_receivable) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_paid_amount()) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_due_amount()) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->expiration->fee_type_wise_total_due_amount($selected_fee_type)) }}</td>
                </tr>
                @php
                    $total_receivable += $collection->total_receivable;
                    $total_paid_amount += $collection->total_paid_amount();
                    $total_due_amount += $collection->total_due_amount();
                    $fee_type_wise_total_due_amount += $collection->expiration->fee_type_wise_total_due_amount($selected_fee_type);
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #f2f2f2">
                <th scope="row"></th>
                <th>TOTAL</th>
                <td style="text-align: right">{{ money_format_india($total_receivable) }}</td>
                <td style="text-align: right">{{ money_format_india($total_paid_amount) }}</td>
                <td style="text-align: right">{{ money_format_india($total_due_amount) }}</td>
                <td style="text-align: right">{{ money_format_india($fee_type_wise_total_due_amount) }}</td>
            </tr>
            <tr style="background: #f2f2f2">
                <th scope="row"></th>
                <th>In Crore </th>
                <td style="text-align: right">{{ $total_receivable/10000000 }}</td>
                <td style="text-align: right">{{ $total_paid_amount/10000000 }}</td>
                <td style="text-align: right">{{ $total_due_amount/10000000 }}</td>
                <td style="text-align: right">{{ $fee_type_wise_total_due_amount/10000000 }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
