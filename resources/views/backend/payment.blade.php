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
                    <form action="{{ route('payment') }}" method="GET" class="row pt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" id="firstName" class="form-control" placeholder="John doe">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-success">
                                <label class="form-label" for="category">Category</label>
                                <select class="form-control form-select select2 filter" id="category" name="category">
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
                                <select class="form-control form-select select2" id="sub_category" name="sub_category">
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
                                <select class="form-control form-select select2 filter" id="select_operator" name="operator">
                                    <option value="" disabled selected>Select sub category</option>
                                    @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}" @if(request()->operator == $operator->id)
                                        selected @endif>{{ $operator->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn waves-effect waves-light w-100 btn-info mt-4">Search</button>
                        </div>
                        <hr class="bg-success" style="height: 10px;">
                        <h4 class="card-title mt-5">Receive amount</h4>
                        <div class="col-12 revinue_col">
                            <div class="row revinue_row">
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
                                        <input type="date" class="form-control reeive_date" id="" name="receive_date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
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
                                    <button type="button" class="btn waves-effect btn-danger mt-4">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button" class="btn waves-effect waves-light w-100 btn-info mt-4 revinue_clone_btn">Add new receive amount</button>
                        </div>
                        <h4 class="card-title mt-5">Pay order</h4>
                        <div class="col-12 pay_order_col">
                            <div class="row pay_order_row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
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
                                <div class="col-md-1">
                                    <button type="button" class="btn waves-effect btn-danger mt-4">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button" class="btn waves-effect waves-light w-100 btn-info mt-4 pay_order_clone_btn">Add new pay order</button>
                        </div>
                        <h4 class="card-title mt-5">Deposit</h4>
                        <div class="col-12 deposit_col">
                            <div class="row deposit_row">
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="form-label" for="">Receive amount</label>
                                        <input type="number" class="form-control reeive_amount" id="" name="receive_amount">
                                    </div>
                                </div>
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
                                <div class="col-md-1">
                                    <button type="button" class="btn waves-effect btn-danger mt-4">RM</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <button type="button" class="btn waves-effect waves-light w-100 btn-info mt-4 deposit_clone_btn">Add new deposit</button>
                        </div>

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

        $( '.revinue_col' ).on( 'change', '.fee_type', function () { 
            let this_fee_type = $(this).val();
            let this_fee_type_wise_periods = $.grep({!! collect($fee_type_wise_periods) !!}, function(value) {
                return value.fee_type === parseInt(this_fee_type);
            });
            period = $(this).closest( ".revinue_row" ).find('.period');
            period.html('<option value="" disabled selected>Select period</option>');
            $.each(this_fee_type_wise_periods, function( key, value ) {
                period.append('<option value="'+value.periods+'">'+value.periods+'</option>');
            });
         });
    });

    $(".revinue_clone_btn").click(function(){
        // $('.revinue_row').not('.cloned').clone().addClass('cloned').appendTo('.revinue_col');
        $clone_div = $('.revinue_row').not('.cloned').clone().addClass('cloned');
        $clone_div.find("span").remove();
        $clone_div.find("select").select2();
        $(".revinue_col").append($clone_div);
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
</script>
@endsection
