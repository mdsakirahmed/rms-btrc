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
                                        <a href="#" class="btn btn-info text-white">Configration</a>
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $operator->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        {{-- @if($operator->payments) --}}
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $operator->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($operators->hasPages())
                        <div class="pagination-wrapper">
                            {{ $operators->links('pagination::bootstrap-4') }}
                        </div>
                        @endif
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
                                    <h4 class="card-title fw-bold">Operator information</h4>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter Name here">
                                            <label for="name">Name</label>
                                        </div>
                                        <x-error name="name" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" wire:model="phone" placeholder="Enter phone here">
                                            <label for="phone">Phone</label>
                                        </div>
                                        <x-error name="phone" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" wire:model="email" placeholder="Enter email here">
                                            <label for="email">Email</label>
                                        </div>
                                        <x-error name="email" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="website" wire:model="website" placeholder="Enter website here">
                                            <label for="website">Website</label>
                                        </div>
                                        <x-error name="website" />
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="address">Address</label>
                                        <textarea cols="30" rows="3" class="form-control" id="address" wire:model="address" placeholder="Enter address here"></textarea>
                                        <x-error name="address" />
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="note">Note</label>
                                        <textarea cols="30" rows="3" class="form-control" id="note" wire:model="note" placeholder="Enter note here"></textarea>
                                        <x-error name="note" />
                                    </div>
                                    {{-- Contact person --}}
                                    <h4 class="card-title mt-5 fw-bold">Contact person</h4>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_name" wire:model="contact_person_name" placeholder="Enter name here">
                                            <label for="contact_person_name">Name</label>
                                        </div>
                                        <x-error name="contact_person_name" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="designation" wire:model="designation" placeholder="Enter designation here">
                                            <label for="designation">Designation</label>
                                        </div>
                                        <x-error name="designation" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_phone" wire:model="contact_person_phone" placeholder="Enter phone here">
                                            <label for="contact_person_phone">Phone</label>
                                        </div>
                                        <x-error name="contact_person_phone" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_email" wire:model="contact_person_email" placeholder="Enter email here">
                                            <label for="contact_person_email">Email</label>
                                        </div>
                                        <x-error name="contact_person_email" />
                                    </div>
                                    {{-- License mapping --}}
                                    <h4 class="card-title mt-5 fw-bold">License mapping</h4>
                                    <div class="col-md-3">
                                        <label for="category">Category</label>
                                        <select name="" id="category" class="form-control" wire:model="category">
                                            <option value="">Select category</option>
                                        </select>
                                        <x-error name="category" />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sub_category">Sub Category</label>
                                        <select name="" id="sub_category" class="form-control" wire:model="sub_category">
                                            <option value="">Select category</option>
                                        </select>
                                        <x-error name="sub_category" />
                                    </div>
                                    <div class="col-6 mt-4 d-flex justify-content-betwee">

                                                <button type="submit" class="btn waves-effect waves-light w-100 btn-info">Submit</button>
                                                <button type="button" class="btn waves-effect waves-light w-100 btn-warning" data-bs-dismiss="modal">Close</button>

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
                dropdownParent: $('#operator_form')
                , theme: "classic"
            });
            $('.select2').on('change', function(e) {
                let elementName = $(this).attr('id');
                var data = $(this).select2("val");
                @this.set(elementName, data);
            });
        });

    </script>
    @endpush
</div>
