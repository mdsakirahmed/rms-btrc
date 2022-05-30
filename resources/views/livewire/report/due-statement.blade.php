<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Due Statement</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Due Statement</li>
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
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sub Category</th>
                                    <th>Category</th>
                                    <th>Operator</th>
                                    <th>Fee Type</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th><input wire:model="search_for_category_name" type="text" class="form-control" placeholder="Sub Category"></th>
                                    <th><input wire:model="search_for_sub_category_name" type="text" class="form-control" placeholder="Category"></th>
                                    <th><input wire:model="search_for_operator_name" type="text" class="form-control" placeholder="Operator"></th>
                                    <th><input wire:model="search_for_receive_fee_type_name" type="text" class="form-control" placeholder="Fee Type"></th>
                                    <th><input wire:model="search_for_receive_period_end_date" type="text" class="form-control" placeholder="Due Date"></th>
                                </tr>
                                @foreach ($operators as $operator)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $operator->category_name }}</td>
                                        <td>{{ $operator->sub_category_name }}</td>
                                        <td>{{ $operator->name }}</td>
                                        <td>{{ $operator->fee_type_name }}</td>
                                        <td title="d-m-Y">{{ date('d-m-Y', strtotime($operator->period_end_date)) }}</td>
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
    </div>
</div>
