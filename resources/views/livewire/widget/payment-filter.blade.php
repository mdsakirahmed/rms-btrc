<div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">First Name</label>
                <input type="text" id="firstName" class="form-control" placeholder="John doe">
            </div>
        </div>
        <div wire:ignore class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label">Category</label>
                <select class="form-control form-select select2" id="select_category" name="select_category">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(request()->select_category == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div wire:ignore class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label">Sub Category</label>
                <select class="form-control form-select select2" id="select-sub_category" name="sub_category">
                    <option value="" disabled selected>Select sub category</option>
                    @foreach ($sub_categories as $sub_category)
                    <option value="{{ $sub_category->id }}" @if(request()->sub_category == $sub_category->id) selected @endif>{{ $sub_category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div wire:ignore class="col-md-2">
            <div class="form-group has-success">
                <label class="form-label">Operator</label>
                <select class="form-control form-select select2" id="select_operator" name="select_operator">
                    <option value="" disabled selected>Select operator</option>
                </select>
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
                    $.each(event.detail.operators_data, function( key, value ) {
                        console.log(value);
                        // $("#select_operator").append('<option value="'+id+'">'+text+'</option>');
                    });
                });
            });


           
        });

    </script>
</div>