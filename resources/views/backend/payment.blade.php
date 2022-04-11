@extends('layouts.backend.app')
@section('content')
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
                <div class="card-body">
                    <form action="{{ route('payment') }}" method="GET" class="row pt-3" id="payment_form">
                        <div class="col-12 error_msg" id="error_msg_payment"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" id="firstName" class="form-control name" placeholder="John doe">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label" for="category">Category</label>
                                <select class="form-control form-select select2 filter category" id="category"
                                    name="category">
                                    <option value="" disabled selected>Select category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(request()->category == $category->id)
                                        selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label" for="sub_category">Sub Category</label>
                                <select class="form-control form-select select2 sub_category" id="sub_category"
                                    name="sub_category">
                                    <option value="" disabled selected>Select sub category</option>
                                    @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}" @if(request()->sub_category ==
                                        $sub_category->id) selected @endif>{{ $sub_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label">Operator</label>
                                <select class="form-control form-select select2 filter operator" id="select_operator"
                                    name="operator">
                                    <option value="" disabled selected>Select sub category</option>
                                    @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}" @if(request()->operator == $operator->id)
                                        selected @endif>{{ $operator->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit"
                                class="btn waves-effect waves-light w-100 btn-info mt-4">Search</button>
                        </div>
                        <hr class="bg-success" style="height: 10px;">
                        <h4 class="card-title mt-5">Receive amount</h4>
                        <div class="col-12 error_msg" id="error_msg_receive"></div>
                        <div class="col-12 receive_col">
                            <div class="row receive_row">
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="fee_type">Fee type</label>
                                        <select class="form-control form-select select2 fee_type" name="fee_type">
                                            <option value="" disabled selected>Select fee type</option>
                                            @foreach ($fee_types as $fee_type)
                                            <option value="{{ $fee_type->fee_type->id }}" @if(request()->fee_type ==
                                                $fee_type->fee_type->id) selected @endif>{{ $fee_type->fee_type->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="period">Select period</label>
                                        <select class="form-control form-select select2 period" id="" name="period">
                                            <option value="" disabled selected>Select period</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive date</label>
                                        <input type="date" class="form-control receive_date" id="" name="receive_date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control receive_amount" id=""
                                            name="receive_amount">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Late (%)</label>
                                        <input type="number" class="form-control late_fee" id="" name="late_fee">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Vat (%)</label>
                                        <input type="number" class="form-control vat" id="" name="vat">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">TAX (%)</label>
                                        <input type="number" class="form-control tax" id="" name="tax">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button"
                                        class="btn waves-effect btn-danger mt-4 remove_receive_row">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button"
                                class="btn waves-effect waves-light w-100 btn-info mt-4 receive_clone_btn">Add new
                                receive amount</button>
                        </div>
                        <h4 class="card-title mt-5">Pay order</h4>
                        <div class="col-12 error_msg" id="error_msg_pay_order"></div>
                        <div class="col-12 pay_order_col">
                            <div class="row pay_order_row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">PO Amount</label>
                                        <input type="number" class="form-control po_amount" id="" name="po_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">PO Number</label>
                                        <input type="number" class="form-control po_number" id="" name="po_number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">PO Date</label>
                                        <input type="date" class="form-control po_date" id="" name="po_date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="po_bank">PO Bank</label>
                                        <select class="form-control form-select select2 po_bank" name="po_bank">
                                            <option value="" disabled selected>Selectbank</option>
                                            @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn waves-effect btn-danger mt-4 remove_pay_order_row">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button"
                                class="btn waves-effect waves-light w-100 btn-info mt-4 pay_order_clone_btn">Add new pay
                                order</button>
                        </div>
                        <h4 class="card-title mt-5">Deposit</h4>
                        <div class="col-12 error_msg" id="error_msg_deposit"></div>
                        <div class="col-12 deposit_col">
                            <div class="row deposit_row">
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Deposit Journal No</label>
                                        <input type="number" class="form-control journal_number" id=""
                                            name="journal_number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Deposit Date</label>
                                        <input type="date" class="form-control daposit_date" id=""
                                            name="daposit_date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="deposit_bank">Deposit Bank</label>
                                        <select class="form-control form-select select2 deposit_bank"
                                            name="deposit_bank">
                                            <option value="" disabled selected>Select fee type</option>
                                            @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn waves-effect btn-danger mt-4 remove_deposit_row">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button" class="btn waves-effect waves-light w-100 btn-info mt-4 deposit_clone_btn">Add new deposit</button>
                        </div>
                        <button type="button" id="payment_submit"
                            class="btn waves-effect waves-light w-100 btn-warning mt-4">Submit Form</button>
                    </form>
                    <!--/row-->
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('.filter').change(function() {
            this.form.submit();
        });

        $( '.receive_col' ).on( 'change', '.fee_type', function () { 
            let this_fee_type = $(this).val();
            let this_fee_type_wise_periods = $.grep({!! collect($fee_type_wise_periods) !!}, function(value) {
                return value.fee_type === parseInt(this_fee_type);
            });
            period = $(this).closest( ".receive_row" ).find('.period');
            period.html('<option value="" disabled selected>Select period</option>');
            $.each(this_fee_type_wise_periods, function( key, value ) {
                period.append('<option value="'+value.periods+'">'+value.periods+'</option>');
            });
        });
    });

    $(".receive_clone_btn").click(function(){
        // $('.receive_row').not('.cloned').clone().addClass('cloned').appendTo('.receive_col');
        $clone_div = $('.receive_row').not('.cloned').clone().addClass('cloned');
        $clone_div.find("span").remove();
        $clone_div.find("select").select2();
        $(".receive_col").append($clone_div);
    });
    $(".pay_order_clone_btn").click(function(){
        // $('.pay_order_row').not('.cloned').clone().addClass('cloned').appendTo('.pay_order_col');
        $clone_div = $('.pay_order_row').not('.cloned').clone().addClass('cloned');
        $clone_div.find("span").remove();
        $clone_div.find("select").select2();
        $(".pay_order_col").append($clone_div);
    });
    $(".deposit_clone_btn").click(function(){
        // $('.deposit_row').not('.cloned').clone().addClass('cloned').appendTo('.deposit_col');
        $clone_div = $('.deposit_row').not('.cloned').clone().addClass('cloned');
        $clone_div.find("span").remove();
        $clone_div.find("select").select2();
        $(".deposit_col").append($clone_div);
    });

    $('.receive_col').on( 'click', '.remove_receive_row', function () { 
        $(this).closest( ".receive_row" ).html('');
    });

    $('.pay_order_col').on( 'click', '.remove_pay_order_row', function () { 
        $(this).closest( ".pay_order_row" ).html('');
    });

    $('.deposit_col').on( 'click', '.remove_deposit_row', function () { 
        $(this).closest( ".deposit_row" ).html('');
    });

    $("#payment_submit").click(function(){
        let payment = [];
        payment.push({
            name : $('#payment_form .name').val(),
            // category : $('#payment_form .category').val(),
            // sub_category : $('#payment_form .sub_category').val(),
            operator : $('#payment_form .operator').val()
        });

        let receives = [];
        $('#payment_form .receive_col .receive_row').each(function(index, obj) {
            receives.push({
                fee_type : $(obj).find('.fee_type').val(),
                period : $(obj).find('.period').val(),
                receive_date : $(obj).find('.receive_date').val(),
                receive_amount : $(obj).find('.receive_amount').val(),
                late_fee : $(obj).find('.late_fee').val(),
                vat : $(obj).find('.vat').val(),
                tax : $(obj).find('.tax').val(),
            });
        });

        let pay_orders = [];
        $('#payment_form .pay_order_col .pay_order_row').each(function(index, obj) {
            pay_orders.push({
                po_amount : $(obj).find('.po_amount').val(),
                po_number : $(obj).find('.po_number').val(),
                po_date : $(obj).find('.po_date').val(),
                po_bank : $(obj).find('.po_bank').val()
            });
        });
       
        let deposits = [];
        $('#payment_form .deposit_col .deposit_row').each(function(index, obj) {
            deposits.push({
                journal_number : $(obj).find('.journal_number').val(),
                daposit_date : $(obj).find('.daposit_date').val(),
                deposit_bank : $(obj).find('.deposit_bank').val(),
            });
        });

        $.ajax({
            type: "POST",
            url: "{{ route('payment') }}",
            data: { "_token": "{{ csrf_token() }}", payment:payment, receives:receives, pay_orders:pay_orders, deposits:deposits }, 
            success: function(obj) {
                console.log(obj);
                $('.error_msg').html("");
                if(obj.error === true){
                    $('#error_msg_'+obj.area+'').html(`<div class="alert alert-danger text-center fw-bold" role="alert">`+obj.message+`</div>`);
                    toastr['error'](obj.message, obj.area ?? ''), toastr.options = {"closeButton": true, "progressBar": true, }
                }else if(obj.error === false){
                    toastr['success']('Successfully done', 'Thank you'), toastr.options = {"closeButton": true, "progressBar": true, }
                    location.reload();
                }
            }
        });
    });
</script>
@endsection