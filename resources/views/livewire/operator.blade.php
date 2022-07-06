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
                <button type="button" wire:click="create" class="btn btn-dark d-none d-lg-block m-l-15" alt="default"
                        data-bs-toggle="modal" data-bs-target=".operator-modal-lg"><i class="fa fa-plus-circle"></i>
                    Create New
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table">
                            <thead class="btrc">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>--</th>
                                <th><input type="text" class="form-control" placeholder="Name"
                                           wire:model="search_for_name"></th>
                                <th><select name="" id="category_id" class="form-control" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th><select name="" id="sub_category_id" class="form-control"
                                            wire:model="sub_category_id">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>--</th>
                            </tr>
                            @foreach ($operators as $operator)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $operator->name }}</td>
                                    <td>{{ $operator->category->name ?? 'Non category' }}</td>
                                    <td>{{ $operator->sub_category->name ?? 'Non sub category' }}</td>
                                    <td>
                                        @can('expiration')
                                            @if($operator->category->fee_types->count() > 0)
                                                <a href="{{ route('expiration', $operator->id) }}"
                                                   class="btn btn-info text-white">Configuration</a>
                                            @else
                                                <b>Category Not Ready Yet</b>
                                            @endif
                                        @endcan
                                        {{--<a href="{{ route('operator-wise-payment', $operator->id) }}" class="btn btn-info text-white">Show Payments</a>--}}
                                        <button type="button" class="btn btn-primary"
                                                wire:click="select_for_edit({{ $operator->id }})" data-bs-toggle="modal"
                                                data-bs-target=".operator-modal-lg">Edit
                                        </button>
                                        <button type="button" class="btn btn-danger text-white"
                                                wire:click="select_for_delete({{ $operator->id }})"
                                                data-bs-toggle="modal" data-bs-target=".delete-modal"> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if ($operators->hasPages())
                            <div class="pagination-wrapper">
                                {{ $operators->links('livewire.widget.custom-pagination') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- operator modal content -->
            <div wire:ignore.self class="modal operator-modal-lg fade" tabindex="-1" data-backdrop="static"
                 role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Operator Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">

                            <form wire:submit.prevent="submit" id="operator_form">
                                <div class="row">
                                    <h4 class="card-title fw-bold">Operator Information</h4>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" wire:model="name"
                                                   placeholder="Enter Name Here">
                                            <label for="name" class="required">Name</label>
                                        </div>
                                        <x-error name="name"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" wire:model="phone"
                                                   placeholder="Enter Phone Here">
                                            <label for="phone">Phone</label>
                                        </div>
                                        <x-error name="phone"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="email" wire:model="email"
                                                   placeholder="Enter Email Here">
                                            <label for="email">Email</label>
                                        </div>
                                        <x-error name="email"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="website" wire:model="website"
                                                   placeholder="Enter Website Here">
                                            <label for="website">Website</label>
                                        </div>
                                        <x-error name="website"/>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="address">Address</label>
                                        <textarea cols="30" rows="3" class="form-control" id="address"
                                                  wire:model="address" placeholder="Enter Address Here"></textarea>
                                        <x-error name="address"/>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="note">Note</label>
                                        <textarea cols="30" rows="3" class="form-control" id="note" wire:model="note"
                                                  placeholder="Enter Note Here"></textarea>
                                        <x-error name="note"/>
                                    </div>
                                    {{-- Contact person --}}
                                    <h4 class="card-title mt-5 fw-bold">Contact Person</h4>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_name"
                                                   wire:model="contact_person_name" placeholder="Enter Name Here">
                                            <label for="contact_person_name" class="">Name</label>
                                        </div>
                                        <x-error name="contact_person_name"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_designation"
                                                   wire:model="contact_person_designation"
                                                   placeholder="Enter Designation Here">
                                            <label for="contact_person_designation">Designation</label>
                                        </div>
                                        <x-error name="contact_person_designation"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_phone"
                                                   wire:model="contact_person_phone" placeholder="Enter Phone Here">
                                            <label for="contact_person_phone">Phone</label>
                                        </div>
                                        <x-error name="contact_person_phone"/>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contact_person_email"
                                                   wire:model="contact_person_email" placeholder="Enter Email Here">
                                            <label for="contact_person_email">Email</label>
                                        </div>
                                        <x-error name="contact_person_email"/>
                                    </div>
                                    {{-- License mapping --}}
                                    <h4 class="card-title mt-5 fw-bold">License Mapping</h4>
                                    <div class="col-md-3">
                                        <label for="category_id" class="required">Category</label>
                                        <select name="" id="category_id" class="form-control" wire:model="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-error name="category_id"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="sub_category_id" class="required">Sub-Category</label>
                                        <select name="" id="sub_category_id" class="form-control"
                                                wire:model="sub_category_id">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-error name="sub_category_id"/>
                                    </div>
                                    <div class="col-6 mt-4 d-flex justify-content-betwee" style="max-height: 40px;">
                                        <button type="submit" class="btn waves-effect waves-light w-100 btn-info">
                                            Submit
                                        </button>
                                        <button type="button" class="btn waves-effect waves-light w-100 btn-warning"
                                                data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
            <!-- delete modal content -->
            <div wire:ignore.self class="modal delete-modal fade" tabindex="-1" data-backdrop="static" role="dialog"
                 aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt=""> <br>
                            <button class="btn btn-danger text-white" data-bs-dismiss="modal" wire:click="delete">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </div>
    </div>

</div>
