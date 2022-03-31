<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Document Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Document Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>Create New</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <div class="form-row row">
                            <div class="form-group col-md-4">
                                <label for="start_date">Start date</label>
                                <input type="date" class="form-control" id="start_date" placeholder="" wire:model="start_date">
                                <x-error name="start_date" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="end_date">End date</label>
                                <input type="date" class="form-control" id="end_date" placeholder="" wire:model="end_date">
                                <x-error name="end_date" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="late_fee">Late fee</label>
                                <select name="" id="late_fee" class="form-control" wire:model="late_fee">
                                    <option value="1">With late fee</option>
                                    <option value="0">Without late fee</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="category">Category</label>
                                <input table="license_categories" column="name" id="category" class="form-control ui_auto_complete" wire:model="category">
                                <x-error name="category" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="sub_category">Sub Category</label>
                                <input table="license_sub_categories" column="name" id="sub_category" class="form-control ui_auto_complete" wire:model="sub_category">
                                <x-error name="sub_category" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="operator">Operator</label>
                                <input table="operators" column="name" id="operator" class="form-control ui_auto_complete" wire:model="oprtator">
                                <x-error name="operator" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="journal_number">Journal number</label>
                                <input table="partial_payments" column="journal_number" type="text" class="form-control ui_auto_complete" id="journal_number" wire:model="journal_number">
                                <x-error name="journal_number" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bank">Bank</label>
                                <select name="" id="bank" class="form-control" wire:model="bank">
                                    <option value="">Choose bank</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                <x-error name="bank" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pay_order_number">Pay order number</label>
                                <input table="partial_payments" column="pay_order_number" type="text" class="form-control ui_auto_complete" id="pay_order_number" wire:model="pay_order_number">
                                <x-error name="pay_order_number" />
                            </div>

                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- jQuery UI --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    {{-- Custom JS --}}
    <script type="text/javascript">
        //Auto Search
        $(".ui_auto_complete").autocomplete({
            source: function(request, response) {
                table = this.element.attr('table');
                column = this.element.attr('column');
                keyword = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('getSuggestionForFilter') }}",
                    data: {
                        'table': table,
                        'column': column,
                        'keyword': keyword
                    },
                    success: function(data) {
                        console.log(data)
                        var array = $.map(data, function(obj) {
                            return {
                                value:  obj.name,
                                label: obj.name,
                            }
                        })
                        response(array);
                    },
                });
            },
            minLength: 3
        });

    </script>

</div>
