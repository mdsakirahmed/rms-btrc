<div>


    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment Page
                <x-loading />
            </h4>
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
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input type="text" id="firstName" class="form-control" placeholder="John doe">
                                </div>
                            </div>
                            <div wire:ignore class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label">Category</label>
                                    <select class="form-control form-select select2" id="select_category">
                                        <option value="" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div wire:ignore class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label">Sub Category</label>
                                    <select class="form-control form-select select2">
                                        <option value="" disabled selected>Select sub category</option>
                                        @foreach ($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div wire:ignore class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label">Operator</label>
                                    <select class="form-control form-select select2" id="select_operator">
                                        <option value="" disabled selected>Select operator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn waves-effect waves-light w-100 btn-info mt-4">Search</button>
                            </div>
                        </div>
                        <!--/row-->
                        <h4 class="card-title mt-5">Receive amount</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div wire:ignore class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label">Fee type</label>
                                    <select class="form-control form-select select2" id="select_fee_type">
                                        <option value="" disabled selected>Select fee type</option>
                                    </select>
                                </div>
                            </div>
                            <div wire:ignore class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="form-label">Select period</label>
                                    <select class="form-control form-select select2" id="period">
                                        <option value="" disabled selected>Select category</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i>Save</button>
                            <button type="button" class="btn btn-dark">Cancel</button>
                        </div>
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

            $('#select_category').on('change', function(e) {
                livewire.emit('select_category', e.target.value);

                window.addEventListener('operators_data_event', event => {
                    let operators_formated_data_set = jQuery.map(event.detail.operators_data, function(val, index) {
                        return { id: val.id , text: val.name };
                    });
                    $('#select_operator').html('').select2({ data: operators_formated_data_set })
                });

                window.addEventListener('category_wise_fee_types_data_event', event => {
                    let category_wise_fee_types_formated_data_set = jQuery.map(event.detail.category_wise_fee_types_data, function(val, index) {
                        return { id: val.id , text: val.fee_type.name };
                    });
                    $('#select_fee_type').html('').select2({ data: category_wise_fee_types_formated_data_set })
                });
            });


            $('#select_operator').on('change', function(e) {
                livewire.emit('select_operator', e.target.value);
            });


            $('#select_fee_type').on('change', function(e) {
                livewire.emit('select_fee_type', e.target.value);
            });
        });

    </script>
</div>
