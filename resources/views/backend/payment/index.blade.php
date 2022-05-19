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
                            @include('backend.payment.partials.operator')
                            @include('backend.payment.partials.receive')
                            @include('backend.payment.partials.po')
                            @include('backend.payment.partials.deposit')
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
                            onClick="window.location.reload()" data-bs-dismiss="modal"
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

    <script>
        $(document).ready(function () {
            $('.filter').change(function () {
                this.form.submit();
            });

            $(".cln_btn").click(function () {
                let clone_div = $(this).closest(".row").not('.cloned').clone().addClass('cloned');
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
                    let late_fee_receive_amount = $(obj).find('.late_fee_receive').val();
                    let late_fee_amount = (receive_amount / 100) * $(obj).find('.late_fee_title').text();
                    let vat = (receive_amount / 100) * $(obj).find('.vat_title').text();
                    let tax = (receive_amount / 100) * $(obj).find('.tax_title').text();
                    let late_days = $(obj).find('.late_days_hidden').val();
                    let late_fee_amount_of_due_days = (late_fee_amount / 365) * late_days;
                    $(obj).find('.late_fee_amount_of_due_days_hidden').val(late_fee_amount_of_due_days);
                    $(obj).find('.late_fee_help_line').text((late_days ?? 0) + ' day = ' + Math.round(late_fee_amount_of_due_days) + ' BDT'); //help text
                    $(obj).find('.vat').val(Math.round(vat));
                    $(obj).find('.tax').val(Math.round(tax));
                    total_amount_of_receive +=
                        parseFloat(receive_amount) +
                        parseFloat(late_fee_receive_amount) +
                        parseFloat(vat) +
                        parseFloat(tax);
                    // console.log("Total late fee (in 365 days) :" + late_fee_amount + "Taka")
                    // console.log("Total late fee 1 day :" + (late_fee_amount/365) + "Taka")
                    // console.log("Total late fee "+late_days+" day :" + late_fee_amount_of_due_days + "Taka")
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
                        late_fee: $(obj).find('.late_fee_title').text(),
                        late_fee_receive: $(obj).find('.late_fee_receive').val(),
                        vat: $(obj).find('.vat_title').text(),
                        tax: $(obj).find('.tax_title').text(),
                        late_days: $(obj).find('.late_days_hidden').val(),
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
        });
    </script>
@endsection
