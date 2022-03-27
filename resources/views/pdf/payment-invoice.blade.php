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
    <div style="text-align:center; background:rgba(0, 140, 255, 0.233); margin:50px; padding:10px; border-radius:20px;">
        <h4>Operator: {{ $payment->expiration->operator->name ?? 'Not found' }}</h4>
        <h4>Category: {{ $payment->expiration->operator->category->name ?? 'Not found' }}</h4>
        <h4>Sub Category: {{ $payment->expiration->operator->sub_category->name ?? 'Not found' }}</h4>
    </div>
    <table id="schedule_tbl" style="width:100%">
        <tr>
            <th>#</th>
            <th>Last date</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
        <tr>
            <td style="text-align: center">1.</td>
            <td style="text-align:center;">{{ $payment->last_date_of_payment->format('d M Y') }}</td>
            <td style="text-align:right;">{{ $payment->payble_amount }} TAKA </td>
            <td style="text-align:center;">
                @if($payment->paid)
                <strong style="color: green">PAID</strong>
                @else
                <strong style="color: red">DUE</strong>
                @endif
            </td>
        </tr>
    </table>
</div>
