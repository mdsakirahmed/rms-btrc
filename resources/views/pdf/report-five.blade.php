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
            <th>No. of Delay Days</th>
            <th style="text-align: right;">Late Fee</th>
            <th style="text-align: right;">VAT</th>
            <th style="text-align: right;">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($operator_model->category->category_wise_fees as $fee_type)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $fee_type->fee_type->name }}</td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ $period->period_label }} <br>
                    @endforeach
                    <br> <b style="border: 2px solid green; padding: 3%;">{{ $loop->iteration }}. Sub-Total</b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ money_format_india($period->total_receivable) }} <br>
                    @endforeach
                    <br>
{{--                    <b style="border: 2px solid green; padding: 3%;">{{ money_format_india($operator_model->fee_type_wise_periods($fee_type->fee_type_id)->sum('total_receivable')) }}</b>--}}
                </td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{  date('d-n-Y', strtotime($period->period_schedule_date)) ?? 'Date Not Found'  }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ date('d/m/Y') }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)) }}
                        <br>
                    @endforeach
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ money_format_india(round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->late_fee_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ money_format_india(round(($period->total_receivable / 100) * $fee_type->vat)) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->vat_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                </td>
                <td style="text-align: right;">
                    @foreach($operator_model->fee_type_wise_periods($fee_type->fee_type_id) as $period)
                        {{ money_format_india($period->total_receivable + round(($period->total_receivable / 100) * $fee_type->vat) + round((((($period->total_receivable / 100) * $fee_type->late_fee) ) / 365) * abs(Carbon\Carbon::now()->diffInDays($period->period_schedule_date, false)))) }}
                        <br>
                    @endforeach
                    <br>
                    <b style="border: 2px solid green; padding: 3%;"> {{ money_format_india(round($operator_model->sum_of_receivable_vat_late_fee_amount_by_fee_type($fee_type->fee_type_id))) }} </b>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection