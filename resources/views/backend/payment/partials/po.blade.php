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
