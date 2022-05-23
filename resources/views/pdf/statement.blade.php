@extends('layouts.pdf.app')
@section('content')

    <table style="width: 100%;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> Operator </th>
                <th scope="col" style="text-align: right"> Receivable </th>
                <th scope="col" style="text-align: right"> Receive </th>
                <th scope="col" style="text-align: right"> Outstanding </th>
                <th scope="col" style="text-align: right"> Previous Due </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $collection)
                <tr @if($loop->odd) style="background: #F7F4F3" @endif>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $collection->expiration->operator->name ?? 'Not found' }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_receivable) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_paid_amount()) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->total_due_amount()) }}</td>
                    <td style="text-align: right">{{ money_format_india($collection->expiration->fee_type_wise_total_due_amount($selected_fee_type)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
