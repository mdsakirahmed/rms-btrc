<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Operator Details</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Operator Details</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" wire:click="export_as_excel">Export as .xlsx</button>
                    <button class="btn btn-success" wire:click="export_as_pdf">Export as .pdf</button>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-3">
                            <select name="" id="" class="form-control" wire:model="selected_category">
                                <option value="all">All Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="" id="" class="form-control" wire:model="selected_sub_category">
                                <option value="all">All Sub Category</option>
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="" id="" class="form-control" wire:model="selected_operator">
                                <option value="all">All Operator</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" wire:model.debounce.500ms="search" placeholder="Search by Name">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Contact Person Name</th>
                                    <th>Contact Person Designation</th>
                                    <th>Contact Person Phone</th>
                                    <th>Contact Person Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operators as $operator)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $operator->category->name ?? '--' }}</td>
                                        <td>{{ $operator->sub_category->name ?? '--' }}</td>
                                        <td>{{ $operator->name }}</td>
                                        <td>{{ $operator->phone }}</td>
                                        <td>{{ $operator->email }}</td>
                                        <td>{{ $operator->website }}</td>
                                        <td>{{ $operator->address }}</td>
                                        <td>{{ $operator->note }}</td>
                                        <td>{{ $operator->contact_person_name }}</td>
                                        <td>{{ $operator->contact_person_designation }}</td>
                                        <td>{{ $operator->contact_person_phone }}</td>
                                        <td>{{ $operator->contact_person_email }}</td>
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
    </div>
</div>
