<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Operator Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Operator Page</li>
                </ol>
                <button type="button" wire:click="create" class="btn btn-dark d-none d-lg-block m-l-15" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus-circle"></i> Create New</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table success-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operators as $operator)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $operator->name }}</td>
                                    <td>{{ $operator->category->name ?? 'Non category' }}</td>
                                    <td>{{ $operator->sub_category->name ?? 'Non sub category' }}</td>
                                    <td>
                                        <a href="{{ route('payment', ['operator' => $operator]) }}" class="btn btn-success text-white">Payments</a>
                                        <a href="{{ route('expiration', ['operator' => $operator]) }}" class="btn btn-info text-white">Configration</a>
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $operator->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        {{-- @if($operator->payments) --}}
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $operator->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- sample modal content -->
            <div wire:ignore.self class="modal bs-example-modal-lg fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Operator Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit" id="operator_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter Name here">
                                            <label for="name">Name</label>
                                        </div>
                                        <x-error name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3" wire:ignore>
                                            <select style="width: 100%;" class="form-control select2" id="category_id" wire:model="category_id">
                                                <option value="">Chose category</option>
                                                <option value="0">Non category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category_id">Category</label>
                                        </div>
                                        <x-error name="category_id" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3" wire:ignore>
                                            <select style="width: 100%;" class="form-control select2" id="sub_category_id" wire:model="sub_category_id">
                                                <option value="">Chose sub category</option>
                                                <option value="0">Non sub category</option>
                                                @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="sub_category_id">Sub Category</label>
                                        </div>
                                        <x-error name="sub_category_id" />
                                    </div>
                                    <div class="col-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="ms-auto mt-3 mt-md-0">
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                                <button type="button" class="btn btn-danger waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
    @push('foot')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#operator_form'),
                theme: "classic"
            });
            $('.select2').on('change', function (e) {
                let elementName = $(this).attr('id');
                var data = $(this).select2("val");
                @this.set(elementName, data);
            });
        });
    </script>
    @endpush
</div>
