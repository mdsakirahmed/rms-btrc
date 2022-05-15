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
