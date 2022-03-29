<style>
    @page {
        margin: 1in;
    }

    #schedule_tbl th,
    td {
        border: 1px dotted black;
        border-collapse: collapse;
    }

</style>

<htmlpageheader name="header">
    <div style="width:100%; text-align:center;">
        <img src="{{ asset('assets/images/logo-icon.png') }}" alt="">
    </div>
</htmlpageheader>

<htmlpagefooter name="footer">
    <table width="100%">
        <tr>
            <td width="50%" style="background: white; border: white;"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
            <td width="50%" align="right" style="font-weight: bold; font-style: italic; background: white; border: white;">Page no. {PAGENO}/{nbpg}</td>
        </tr>
    </table>
</htmlpagefooter>

<sethtmlpageheader name="header" value="on" show-this-page="1" />
<sethtmlpagefooter name="footer" value="on" />

{{-- Bode Document --}}
<div>
    <div style="text-align:center; background: rgba(0, 128, 0, 0.219); margin:50px; padding:10px; border-radius:20px;">
        <h4>Operator: {{ $payment->expiration->operator->name ?? 'Not found' }}</h4>
        <h4>Category: {{ $payment->expiration->operator->category->name ?? 'Not found' }}</h4>
        <h4>Sub Category: {{ $payment->expiration->operator->sub_category->name ?? 'Not found' }}</h4>
    </div>

    <div style="width: 100%; text-align:center; margin-bottom:50px;">
        <div style="width:180px; float:left; border: 5px solid green; border-radius:15px; background: rgba(0, 128, 0, 0.219);">
            Payble: {{ $payment->payble_amount }}
        </div>
        <div style="width:180px; float:left; border: 5px solid green; border-radius:15px; background: rgba(0, 128, 0, 0.219); margin-left:13px;">
            Paid: {{ $payment->paid() }}
        </div>
        <div style="width:180px; float:right; border: 5px solid rgb(128, 0, 0); border-radius:15px; background: rgba(128, 0, 0, 0.219);">
            Due: {{ $payment->due() }}
        </div>
    </div>

    <table id="schedule_tbl" style="width:100%">
        <tr>
            <th>#</th>
            <th>Payment date</th>
            <th>Amount</th>
            <th>Bank</th>
        </tr>
        @foreach ($payment->partial_payments as $partial_payment)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="text-align:center;">{{ $partial_payment->payment_date->format('d M Y') }}</td>
            <td style="text-align:right;">{{ $partial_payment->paid_amount }} TAKA </td>
            <td style="text-align:center;">{{ $partial_payment->bank->name ?? 'Not Found' }} TAKA </td>
        </tr>
        @endforeach
    </table>

    <br>

    <h3 style="color:red;"> ** You are requested to complete <b>{{  $payment->payble_amount ?? 00 }} TAKA</b> within {{ $payment->last_date_of_payment->format('d M Y') ?? 'Not Found' }}</h3>

</div>
