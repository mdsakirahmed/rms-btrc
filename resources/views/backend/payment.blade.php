@extends('layouts.backend.app')
@section('content')
    <style>
        .cln__or_rm_div {
            margin-top: 6px;
        }

        .cln__or_rm_div i {
            /* font-size: 30px; */
            paddind: 100px;
        }

        /* Date format css 1 */
        input[type="date"]::-webkit-datetime-edit,
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-clear-button {
            color: #fff;
            position: relative;
        }

        input[type="date"]::-webkit-datetime-edit-year-field {
            position: absolute !important;
            border-left: 1px solid #8c8c8c;
            padding: 2px;
            color: #000;
            left: 56px;
        }

        input[type="date"]::-webkit-datetime-edit-month-field {
            position: absolute !important;
            border-left: 1px solid #8c8c8c;
            padding: 2px;
            color: #000;
            left: 26px;
        }


        input[type="date"]::-webkit-datetime-edit-day-field {
            position: absolute !important;
            color: #000;
            padding: 2px;
            left: 4px;

        }

        /* Date format css 0 */

    </style>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Payment Page</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="form-body">
                    <div class="card-body" id="payment_body">
                        <form action="{{ route('payment') }}" method="GET" class="row pt-3" id="payment_form">
                            <div class="col-12 error_msg" id="error_msg_payment"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label required">Transaction Number</label>
                                    <input type="text" id="transaction" class="form-control transaction"
                                           placeholder="2203-name-01000"
                                           value="{{ date('ym') }}-{{ convert_to_initial(auth()->user()->name) }}-{{ sprintf("%'.05d\n", (App\Models\Payment::latest()->first()->id ?? 0) + 1) }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label required" for="category">Select Category</label>
                                    <select class="form-control form-select select2 filter category" id="category"
                                            name="category">
                                        <option value="" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if (request()->category == $category->id)
                                                        selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label required" for="sub_category">Sub-Category</label>
                                    <select class="form-control form-select select2 filter sub_category"
                                            id="sub_category" name="sub_category">
                                        <option value="" selected>Select sub category</option>
                                        @foreach ($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}" @if (request()->sub_category ==
                                        $sub_category->id) selected @endif>
                                                {{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label required">Select Operator</label>
                                    <select class="form-control form-select select2 filter operator"
                                            id="select_operator" name="operator">
                                        <option value="" disabled selected>Select operator</option>
                                        @foreach ($operators as $operator)
                                            <option value="{{ $operator->id }}"
                                                    @if (request()->operator == $operator->id)
                                                        selected @endif>{{ $operator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top: 6px;">
                                <button type="submit" class="btn waves-effect waves-light w-100 btn-info mt-4">Search
                                </button>
                            </div>
                            <hr class="bg-success" style="height: 10px;">
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
                                            <select class="form-control form-select select2 period" id="" name="period">
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
                                            <input type="date" class="form-control receive_date" id=""
                                                   name="receive_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">Receive Amount ( <b
                                                    class="text-success receive_amount_title">--</b> )</label>
                                            <input type="number" class="form-control receive_amount" id=""
                                                   name="receive_amount" step="0.001">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">Late (%)</label>
                                            <input type="number" class="form-control late_fee" id="" name="late_fee"
                                                   step="0.001">
                                            <input type="hidden" class="late_fee_hidden">
                                            <input type="hidden" class="differ_from_period_day_hidden">
                                            <input type="hidden" class="late_fee_amount_of_due_days_hidden">
                                            <p class="text-danger late_fee_help_line"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">VAT (%)</label>
                                            <input type="number" class="form-control vat" id="" name="vat" step="0.001">
                                            <p class="text-danger vat_help_line"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">TAX (%)</label>
                                            <input type="number" class="form-control tax" id="" name="tax" step="0.001">
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
                            <h4 class="card-title mt-5">Pay Order</h4>
                            <div class="col-12 error_msg" id="error_msg_pay_order"></div>
                            <div class="col-12 column pay_order_col">
                                <div class="row pay_order_row">
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">PO Amount</label>
                                            <input type="number" class="form-control po_amount" id="" name="po_amount"
                                                   step="0.001">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">PO Number</label>
                                            <input type="text" class="form-control po_number" id="" name="po_number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">PO Date</label>
                                            <input type="date" class="form-control po_date" id="" name="po_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="po_bank">PO Bank</label>
                                            <select class="form-control form-select select2 po_bank" name="po_bank">
                                                <option value="" disabled selected>Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 cln__or_rm_div">
                                        <button type="button" class="btn btn-success mt-4 w-100 cln_btn"
                                                title="Add new one"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-row-reverse bd-highlight">
                                <div class="p-2 bd-highlight fw-bold">Total Pay Order Amount is: <b
                                        id="total_amount_of_pay_order">0</b> BDT
                                </div>
                            </div>
                            <h4 class="card-title mt-5">Deposit</h4>
                            <div class="col-12 error_msg" id="error_msg_deposit"></div>
                            <div class="col-12 column deposit_col">
                                <div class="row deposit_row">
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">Deposit Amount</label>
                                            <input type="number" class="form-control deposit_amount" id=""
                                                   placeholder="Deposit amount" name="deposit_amount" step="0.001">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">Deposit Journal No</label>
                                            <input type="text" class="form-control journal_number" id=""
                                                   placeholder="Journal number" name="journal_number">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="">Deposit Date</label>
                                            <input type="date" class="form-control deposit_date" id=""
                                                   name="deposit_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group has-success">
                                            <label class="form-label required" for="deposit_bank">Select Bank</label>
                                            <select class="form-control form-select select2 deposit_bank"
                                                    name="deposit_bank">
                                                <option value="" disabled selected>Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 cln__or_rm_div">
                                        <button type="button" class="btn btn-success mt-4 w-100 cln_btn"
                                                title="Add new one"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-row-reverse bd-highlight">
                                <div class="p-2 bd-highlight fw-bold">Total Deposit Amount is: <b
                                        id="total_amount_of_deposit">0</b> BDT
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="button" id="payment_submit"
                                        class="btn waves-effect waves-light w-25 btn-success mt-4 mr-2">Submit Form
                                </button>
                                <a href="{{ route('payment') }}"
                                   class="btn waves-effect waves-light w-25 btn-warning mt-4 ml-2">Reset Form</a>
                            </div>

                        </form>
                        <!--/row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sample modal content -->
    <div class="modal bs-example-modal-lg fade" id="payment_repeipt_modal" tabindex="-1" data-backdrop="static"
         data-keyboard="false" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title" id="">Payment Receipt</h4>
                    <button type="button" class="btn-close"
                            {{--onClick="window.location.reload()"--}} data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                </div>
                <div class="modal-body" style="height: 6in;">
                    {{-- Show receipt by jquery --}}
                    <iframe src="" frameborder="0" id="payment_repeipt_iframe" height="100%" width="100%"></iframe>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{--
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function () {
            // $('.select2').select2();
            $('.filter').change(function () {
                this.form.submit();
            });
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
                $(this).closest(".receive_row").find('.late_fee_hidden').val(late_fee);
                $(this).closest(".receive_row").find('.vat').val(vat);
                $(this).closest(".receive_row").find('.tax').val(tax);
                $(this).closest(".receive_row").find('.schedule_date').val("");
                let receive_date = $(this).closest(".receive_row").find('.receive_date').val();
                let period_end_date = $(this).closest(".receive_row").find('.period').val();
                if (new Date(receive_date).setHours(0, 0, 0, 0) > new Date(period_end_date).setHours(0, 0,
                    0, 0)) {
                    // Date is past and late fee applicable
                    $(this).closest(".receive_row").find('.late_fee').val(late_fee);
                    let differ_from_period_day = Math.round((new Date($(this).closest(".receive_row").find(
                        '.receive_date').val()).setHours(0, 0, 0, 0) - new Date($(this).closest(
                        ".receive_row").find('.period').val()).setHours(0, 0, 0, 0)) / (1000 * 60 *
                        60 * 24));
                    $(this).closest(".receive_row").find('.differ_from_period_day_hidden').val(
                        differ_from_period_day);
                } else {
                    // Date is not past and late fee is not applicable
                    $(this).closest(".receive_row").find('.late_fee').val(0);
                }
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
        });
        $(".cln_btn").click(function () {
            let clone_div = $(this).closest(".row").not('.cloned').clone().addClass('cloned');
            // clone_div.find("span").remove();
            // clone_div.find("select").select2();
            clone_div.find(".cln__or_rm_div").html(
                `<button type="button" class="btn btn-danger w-100 mt-4 rm_btn" title="Remove this one"><i class="fa fa-times text-white"></i></button>`
            );
            $(this).closest(".column").append(clone_div);
        });
        $('#payment_form').on('click', '.rm_btn', function () {
            $(this).closest(".row").remove();
            calculation();
        });
        $('#payment_form').on('keyup change', function () {
            calculation();
        });

        function calculation() {
            let total_amount_of_receive = 0;
            $('.receive_row').each(function (index, obj) {
                let receive_amount = $(obj).find('.receive_amount').val();
                let late_fee_amount = (receive_amount / 100) * $(obj).find('.late_fee').val();
                let vat = (receive_amount / 100) * $(obj).find('.vat').val();
                let tax = (receive_amount / 100) * $(obj).find('.tax').val();
                let differ_from_period_day = $(obj).find('.differ_from_period_day_hidden').val();
                let late_fee_amount_of_due_days = (late_fee_amount / 365) * differ_from_period_day;
                $(obj).find('.late_fee_amount_of_due_days_hidden').val(late_fee_amount_of_due_days);
                $(obj).find('.late_fee_help_line').text((differ_from_period_day ?? 0) + ' day = ' + Math.round(late_fee_amount_of_due_days) + ' BDT'); //help text
                $(obj).find('.vat_help_line').text(Math.round(vat) + ' BDT'); //help text
                $(obj).find('.tax_help_line').text(Math.round(tax) + ' BDT'); //help text
                total_amount_of_receive +=
                    parseFloat(receive_amount) +
                    parseFloat(late_fee_amount_of_due_days) +
                    parseFloat(vat) +
                    parseFloat(tax);
                // console.log("Total late fee (in 365 days) :" + late_fee_amount + "Taka")
                // console.log("Total late fee 1 day :" + (late_fee_amount/365) + "Taka")
                // console.log("Total late fee "+differ_from_period_day+" day :" + late_fee_amount_of_due_days + "Taka")
            });
            let total_amount_of_pay_order = 0;
            $('.pay_order_row').each(function (index, obj) {
                total_amount_of_pay_order += parseFloat($(obj).find('.po_amount').val());
            });
            let total_amount_of_deposit = 0;
            $('.deposit_row').each(function (index, obj) {
                total_amount_of_deposit += parseFloat($(obj).find('.deposit_amount').val());
            });
            $('#total_amount_of_receive').text(Math.round(total_amount_of_receive));
            $('#total_amount_of_pay_order').text(total_amount_of_pay_order);
            $('#total_amount_of_deposit').text(total_amount_of_deposit);
            $('#payment_form input').each(function (index, obj) {
                if ($(obj).val()) {
                    $(obj).css({
                        "backgroundColor": "#EFFCF3"
                    });
                } else {
                    $(obj).css({
                        "backgroundColor": "#FCF0EF"
                    });
                }
            });
            $('#payment_form select').each(function (index, obj) {
                if ($(obj).val()) {
                    $(obj).css({
                        "backgroundColor": "#EFFCF3"
                    });
                } else {
                    $(obj).css({
                        "backgroundColor": "#FCF0EF"
                    });
                }
            });
        }

        $("#payment_submit").click(function () {
            let payment = [];
            payment.push({
                transaction: $('#payment_form .transaction').val(),
                // category : $('#payment_form .category').val(),
                // sub_category : $('#payment_form .sub_category').val(),
                operator: $('#payment_form .operator').val()
            });
            let receives = [];
            $('#payment_form .receive_col .receive_row').each(function (index, obj) {
                receives.push({
                    fee_type: $(obj).find('.fee_type').val(),
                    period: $(obj).find('.period').val(),
                    receive_date: $(obj).find('.receive_date').val(),
                    receive_amount: $(obj).find('.receive_amount').val(),
                    late_fee: $(obj).find('.late_fee').val(),
                    vat: $(obj).find('.vat').val(),
                    tax: $(obj).find('.tax').val(),
                    differ_from_period_day: $(obj).find('.differ_from_period_day_hidden').val(),
                    late_fee_amount_of_due_days: $(obj).find('.late_fee_amount_of_due_days_hidden').val(),
                });
            });
            let pay_orders = [];
            $('#payment_form .pay_order_col .pay_order_row').each(function (index, obj) {
                pay_orders.push({
                    po_amount: $(obj).find('.po_amount').val(),
                    po_number: $(obj).find('.po_number').val(),
                    po_date: $(obj).find('.po_date').val(),
                    po_bank: $(obj).find('.po_bank').val()
                });
            });
            let deposits = [];
            $('#payment_form .deposit_col .deposit_row').each(function (index, obj) {
                deposits.push({
                    deposit_amount: $(obj).find('.deposit_amount').val(),
                    journal_number: $(obj).find('.journal_number').val(),
                    deposit_date: $(obj).find('.deposit_date').val(),
                    deposit_bank: $(obj).find('.deposit_bank').val(),
                });
            });
            if ($('#total_amount_of_receive').text() != $('#total_amount_of_pay_order').text() || $(
                '#total_amount_of_receive').text() != $('#total_amount_of_deposit').text()) {
                $('.error_msg').html("");
                toastr['error']('Receive, PO, Deposit amount is not equal', 'Amount'), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('payment') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        payment: payment,
                        receives: receives,
                        pay_orders: pay_orders,
                        deposits: deposits
                    },
                    success: function (response) {
                        console.log(response);
                        $('.error_msg').html("");
                        if (response.error === true) {
                            $('#error_msg_' + response.area + '').html(
                                `<div class="alert alert-danger text-center fw-bold" role="alert">` +
                                response.message + `</div>`);
                            toastr['error'](response.message, response.area ?? ''), toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            }
                        } else if (response.error === false) {
                            toastr['success']('Successfully done', 'Thank you'), toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                            }
                            // Receipt open
                            $('#payment_repeipt_iframe').attr('src', response.receipt_url);
                            $('#payment_repeipt_modal').modal({
                                backdrop: 'static',
                                keyboard: true,
                                // show: true
                            });
                            $('#payment_repeipt_modal').modal('show');
                        }
                    }
                });
            }
        });
    </script>
@endsection
