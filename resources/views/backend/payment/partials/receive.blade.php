<h4 class="card-title mt-5">Receive Amount</h4>
<div class="col-12 error_msg" id="error_msg_receive"></div>
<div class="col-12 column receive_col">
    <div class="row receive_row">
        <div class="col-md-3">
            <div class="form-group has-success">
                <label class="form-label required" for="fee_type">Fee Type</label>
                <select class="form-control form-select select2 fee_type" name="fee_type">
                    <option value="" disabled selected>Select fee type</option>
                    @foreach ($fee_types as $fee_type)
                        <option value="{{ $fee_type->fee_type->id }}" @if (request()->fee_type ==
                                                $fee_type->fee_type->id) selected @endif>
                            {{ $fee_type->fee_type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group has-success">
                <label class="form-label required" for="period">Select Period</label>
                <select class="form-control form-select select2 period auto_fill_late_fee_amount" id="" name="period">
                    <option value="" disabled selected>Select period</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group has-success">
                <label class="form-label" for="">Schedule Date</label>
                <input type="text" class="form-control mt-1 schedule_date" id=""
                       name="schedule_date" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group has-success">
                <label class="form-label required" for="">Receive Date</label>
                <input type="date" class="form-control receive_date auto_fill_late_fee_amount" id=""
                       name="receive_date">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group has-success">
                <label class="form-label required" for="">Receive Amount ( <b
                        class="text-success receive_amount_title">--</b> )</label>
                <input type="number" class="form-control receive_amount auto_fill_late_fee_amount" id=""
                       name="receive_amount" step="0.001">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label required" for="">Late ( <b class="text-success late_fee_title">--</b>%)</label>
                <input type="number" class="form-control late_fee_receive" id="" name="late_fee_receive" step="0.001">
                <input type="hidden" class="differ_from_period_day_hidden">
                <input type="hidden" class="late_fee_amount_of_due_days_hidden">
                <p class="text-danger late_fee_help_line"></p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label required" for="">VAT (<b class="text-success vat_title">--</b>%)</label>
                <input type="number" class="form-control vat" id="" name="vat" step="0.001" disabled>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label required" for="">TAX (<b class="text-success tax_title">--</b>%)</label>
                <input type="number" class="form-control tax" id="" name="tax" step="0.001" disabled>
                <p class="text-danger tax_help_line"></p>
            </div>
        </div>
        <div class="col-2 cln__or_rm_div">
            <button type="button" class="btn btn-success w-100 mt-4 cln_btn"
                    title="Add new one"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>
<div class="col-12 d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight fw-bold">Total Receive Amount is: <b
            id="total_amount_of_receive">0</b> BDT
    </div>
</div>
{{--Receive Amount jQuery--}}
<script>
    $(document).ready(function () {
        $('.receive_col').on('change', '.fee_type', function () {
            let this_fee_type = $(this).closest(".receive_row").find('.fee_type').val();
            let this_fee_type_wise_periods = $.grep({!! collect($fee_type_wise_periods) !!}, function (value) {
                return value.fee_type === parseInt(this_fee_type);
            });
            period = $(this).closest(".receive_row").find('.period');
            period.html('<option value="" disabled selected>Select period</option>');
            $.each(this_fee_type_wise_periods, function (key, value) {
                period.append('<option value="' + value.period + '">' + value.period_level +
                    '</option>');
            });
            let amount = late_fee = vat = tax = 0;
            $.grep({!! collect($fee_type_wise_pre_set_amount) !!}, function (value) {
                if (value.fee_type === parseInt(this_fee_type)) {
                    amount = value.amount;
                    late_fee = value.late_fee;
                    vat = value.vat;
                    tax = value.tax;
                }
            });
            $(this).closest(".receive_row").find('.receive_amount_title').text(amount);
            $(this).closest(".receive_row").find('.late_fee_title').text(late_fee);
            $(this).closest(".receive_row").find('.vat_title').text(vat);
            $(this).closest(".receive_row").find('.tax_title').text(tax);
            $(this).closest(".receive_row").find('.vat').val("");
            $(this).closest(".receive_row").find('.tax').val("");
            $(this).closest(".receive_row").find('.schedule_date').val("");
        });
        $('.receive_col').on('change', '.period', function () {
            const this_date = new Date($(this).val());
            $(this).closest(".receive_row").find('.schedule_date').val(this_date.getDate() + '/' + (
                this_date.getMonth() + 1) + '/' + this_date.getFullYear());
        });
        $('.receive_col').on('change', '.receive_date', function () {
            let receive_date = $(this).val();
            let late_fee = $(this).closest(".receive_row").find('.late_fee_hidden').val();
            let period_end_date = $(this).closest(".receive_row").find('.period').val();
            if (new Date(receive_date).setHours(0, 0, 0, 0) > new Date(period_end_date).setHours(0, 0,
                0, 0)) {
                // Date is past and late fee applicable
                $(this).closest(".receive_row").find('.late_fee').val(late_fee);
                let differ_from_period_day = Math.round((new Date($(this).closest(".receive_row").find(
                    '.receive_date').val()).setHours(0, 0, 0, 0) - new Date($(this).closest(
                    ".receive_row").find('.period').val()).setHours(0, 0, 0, 0)) / (1000 * 60 *
                    60 * 24));
                $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val(differ_from_period_day);
            } else {
                // Date is not past and late fee is not applicable
                $(this).closest(".receive_row").find('.late_fee').val(0);
                $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val(0);
            }
        });
        $('.receive_col').on('change', '.auto_fill_late_fee_amount', function () {
            let receive_date = $(this).closest(".receive_row").find('.receive_date').val();
            let period_end_date = $(this).closest(".receive_row").find('.period').val();
            if (new Date(receive_date).setHours(0, 0, 0, 0) > new Date(period_end_date).setHours(0, 0, 0, 0)) {
                // Date is past and late fee applicable
                let differ_from_period_day = Math.round((new Date($(this).closest(".receive_row").find(
                    '.receive_date').val()).setHours(0, 0, 0, 0) - new Date($(this).closest(
                    ".receive_row").find('.period').val()).setHours(0, 0, 0, 0)) / (1000 * 60 *
                    60 * 24));
                $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val(differ_from_period_day);
            } else {
                // Date is not past and late fee is not applicable
                $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val(0);
            }

            let receive_amount = $(this).closest(".receive_row").find('.receive_amount').val();
            let late_fee_percentage = $(this).closest(".receive_row").find('.late_fee_title').text();

            $(this).closest(".receive_row").find('.late_fee_receive').val(Math.round(
                (((receive_amount / 100) * late_fee_percentage) / 365) * $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val()
                ));
        });
    });


</script>
