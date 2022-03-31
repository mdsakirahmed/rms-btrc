@extends('layouts.backend.app')
@section('content')
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
                <form id="filter_form" action="{{ route('report') }}" method="get">
                    <div class="form-row row">
                        <div class="form-group col-md-4">
                            <label for="start_date">Start date</label>
                            <input type="date" class="form-control filter_element" id="start_date" placeholder="" name="start_date">
                            <x-error name="start_date" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="end_date">End date</label>
                            <input type="date" class="form-control filter_element" id="end_date" placeholder="" name="end_date">
                            <x-error name="end_date" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="late_fee">Late fee</label>
                            <select id="late_fee" class="form-control filter_element" name="late_fee">
                                <option value="1">With late fee</option>
                                <option value="0">Without late fee</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category">Category</label>
                            <input table="license_categories" column="name" id="category" class="form-control ui_auto_complete filter_element" name="category">
                            <x-error name="category" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="sub_category">Sub Category</label>
                            <input table="license_sub_categories" column="name" id="sub_category" class="form-control ui_auto_complete filter_element" name="sub_category">
                            <x-error name="sub_category" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="operator">Operator</label>
                            <input table="operators" column="name" id="operator" class="form-control ui_auto_complete filter_element" name="operator">
                            <x-error name="operator" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="journal_number">Journal number</label>
                            <input table="partial_payments" column="journal_number" type="text" class="form-control ui_auto_complete filter_element" id="journal_number" name="journal_number">
                            <x-error name="journal_number" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bank">Bank</label>
                            <select id="bank" class="form-control filter_element" name="bank">
                                <option value="">Choose bank</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                            <x-error name="bank" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pay_order_number">Pay order number</label>
                            <input table="partial_payments" column="pay_order_number" type="text" class="form-control ui_auto_complete filter_element" id="pay_order_number" name="pay_order_number">
                            <x-error name="pay_order_number" />
                        </div>

                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th class="bg-dark text-white">#</th>
                        <th class="bg-primary text-white" title="Partial payment">Payment date</th>
                        <th class="bg-primary text-white" title="Partial payment">Payment amount</th>
                        <th class="bg-primary text-white" title="Partial payment">Vat</th>
                        <th class="bg-primary text-white" title="Partial payment">Late fee</th>
                        <th class="bg-primary text-white" title="Partial payment">Bank</th>
                        <th class="bg-primary text-white" title="Partial payment">Pay order number</th>
                        <th class="bg-primary text-white" title="Partial payment">Journal number</th>
                        <th class="bg-success text-white" title="Payment">Last date of payment</th>
                        <th class="bg-success text-white" title="Payment">Total payble</th>
                        <th class="bg-warning text-white" title="Configration">Issue date</th>
                        <th class="bg-warning text-white" title="Configration">Expire date</th>
                        <th class="bg-warning text-white" title="Configration">Total amount</th>
                        <th class="bg-warning text-white" title="Configration">Fee</th>
                        <th class="bg-warning text-white" title="Configration">Iteration</th>
                        <th class="bg-danger text-white" title="Operator">Oterator</th>
                        <th class="bg-info text-white" title="Category">Category</th>
                        <th class="bg-dark text-white" title="Sub Category">Sub Category</th>
                    </thead>
                    <tbody>
                        @if(count($data_set) > 0)
                        @foreach ($data_set as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->payment_date->format('d M Y') ?? 'not found' }}</td>
                            <td>{{ $data->paid_amount ?? 'not found' }}</td>
                            <td>{{ $data->vat ?? 'not found' }}</td>
                            <td>{{ $data->late_fee ?? 'not found' }}</td>
                            <td>{{ $data->bank->name ?? 'not found' }}</td>
                            <td>{{ $data->pay_order_number ?? 'not found' }}</td>
                            <td>{{ $data->journal_number ?? 'Not found' }}</td>
                            <td>{{ $data->payment->last_date_of_payment ?? 'Not found' }}</td>
                            <td>{{ $data->payment->payble_amount ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->issue_date ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->expire_date ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->price ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->fee ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->iteration ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->operator->name ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->operator->category->name ?? 'Not found' }}</td>
                            <td>{{ $data->payment->expiration->operator->sub_category->name ?? 'Not found' }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>
                                <h1>
                                    No Data Found
                                </h1>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                </div>
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

    $('#filter_form').submit(function(e){
        $('.filter_element').each(function(){
            console.log($(this).val());
        });

        $.get(url, function( data ) {
            console.log(data);
        });
    });
</script>
@endsection
@push('head')

@endpush

@push('foot')

@endpush
