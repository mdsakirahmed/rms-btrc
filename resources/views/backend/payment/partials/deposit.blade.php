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
