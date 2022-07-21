@extends('layouts.pdf.app')
@section('content')
    <h3># Category: {{ $category }} #Sub category: {{ $sub_category }} #Operator: {{ $operator_model->name }}</h3>
    <table style="width: 100%;" class="table" cellpading="0" cellspacing="0">
        <thead>
        <tr>
            <th>SL</th>
            <th>Particulars</th>
            <th>Period</th>
            <th style="text-align: right;">Receivable</th>
            <th>Due Date of Payment</th>
            <th>Receive Date</th>
            <th style="text-align: right;">No. of Delay Days</th>
            <th style="text-align: right;">Late Fee</th>
            <th style="text-align: right;">VAT</th>
            <th style="text-align: right;">Total</th>
        </tr>
        </thead>
        <tbody>
        @php $total_receivable = 0; $total_late_fee = 0; $total_vat = 0; $total_of_total = 0; @endphp
        @foreach($operator_model->category->fee_types as $fee_type)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $fee_type->name }}</td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ $period->period_label }} <br>
                    @endforeach
                    <br> <b style="border: 2px solid green; padding: 3%;">{{ $loop->iteration }}. Sub-Total</b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ money_format_india($period->total_receivable) }} <br>
                    @endforeach
                    <br>
                   <b style="border: 2px solid green; padding: 3%;">{{ collect(round($operator_model->fee_type_wise_periods($fee_type->id)->sum('total_receivable'))) }}</b>
                        @php $total_receivable += $operator_model->fee_type_wise_periods($fee_type->id)->sum('total_receivable'); @endphp
                </td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{  date('d-n-Y', strtotime($period->period_schedule_date)) ?? 'Date Not Found'  }} <br>
                    @endforeach
                    <br>
                    <b style="padding: 3%;">---</b>
                </td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ date('d/m/Y') }} <br>
                    @endforeach
                    <br>
                    <b style="padding: 3%;">---</b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="padding: 3%;">---</b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ money_format_india(round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->late_fee_amount_by_fee_type($fee_type->id))) }} </b>
                        @php $total_late_fee += round($operator_model->late_fee_amount_by_fee_type($fee_type->id)); @endphp
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ money_format_india(round(($period->total_receivable / 100) * $fee_type->vat)) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->vat_amount_by_fee_type($fee_type->id))) }} </b>
                        @php $total_vat += round($operator_model->vat_amount_by_fee_type($fee_type->id)); @endphp
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->id) as $period)
                        {{ money_format_india($period->total_receivable + round(($period->total_receivable / 100) * $fee_type->vat) + round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->sum_of_receivable_vat_late_fee_amount_by_fee_type($fee_type->id))) }} </b>
                        @php $total_of_total += round($operator_model->sum_of_receivable_vat_late_fee_amount_by_fee_type($fee_type->id)); @endphp
                </td>
            </tr>
        @endforeach
        <tr>
            <th>---</th>
            <th>---</th>
            <th>Total</th>
            <th style="text-align: right;"> {{ money_format_india($total_receivable) }} </th>
            <th>----</th>
            <th>----</th>
            <th>----</th>
            <th style="text-align: right;">{{ money_format_india($total_late_fee) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_vat) }}</th>
            <th style="text-align: right;">{{ money_format_india($total_of_total) }}</th>
        </tr>
        </tbody>
    </table>
@endsection
