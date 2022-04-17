<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Due statement</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Due statement</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" wire:click="export">Export as .xlsx</button>
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
                            <input type="text" class="form-control" wire:model.debounce.500ms="search" placeholder="Search by category name">
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
                                    <th>Receive date</th>
                                    <th>Particular</th>
                                    <th>Period</th>
                                    <th>Fee</th>
                                    <th>VAT %</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th><input type="text" class="form-control" placeholder="Sub Category"></th>
                                    <th><input type="text" class="form-control" placeholder="Category"></th>
                                    <th><input type="text" class="form-control" placeholder="Operator"></th>
                                    <th><input type="text" class="form-control" placeholder="Receive date"></th>
                                    <th><input type="text" class="form-control" placeholder="Particular"></th>
                                    <th><input type="text" class="form-control" placeholder="Period"></th>
                                    <th><input type="text" class="form-control" placeholder="Fee"></th>
                                    <th><input type="text" class="form-control" placeholder="VAT %"></th>
                                </tr>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->category_name }}</td>
                                        <td>{{ $payment->sub_category_name }}</td>
                                        <td>{{ $payment->operator_name }}</td>
                                        <td>{{ $payment->receive_date }}</td>
                                        <td>{{ $payment->fee_type_name }}</td>
                                        <td>{{ $payment->period_date }}</td>
                                        <td>{{ $payment->receive_amount }}</td>
                                        <td>{{ $payment->receive_vat }} %</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($payments->hasPages())
                        <div class="pagination-wrapper">
                            {{ $payments->links('pagination::bootstrap-4') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
