<div>
    <style>
        table {
            white-space: nowrap;
        }

    </style>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Statement</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Statement</li>
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

                    {{-- <div class="row mb-5">
                        <div class="col-4">
                            <select name="" id="" class="form-control @error('category') border-danger @endif" wire:model="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="date" name="" id="" class="form-control @error('starting_date') border-danger @endif" wire:model="starting_date">
                        </div>
                        <div class="col-3">
                            <input type="date" name="" id="" class="form-control @error('ending_date') border-danger @endif" wire:model="ending_date">
                        </div>
                        <button class="btn btn-success col-2 text-white" type="button" wire:click="generate">Generate</button>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name of VSP</th>
                                    <th>Operator</th>
                                    <th>P.O No</th>
                                    <th>P.O Date</th>
                                    <th>Name of Bank</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statements as $statement)
                                {{-- 
                                     +"category_name": "2G Cellular Mobile Telecom Operator"
  +"operator_id": 378
  +"operator_name": "Rickie Herzog"
  +"expiration_id": 7
  +"payment_id": 13
  +"transaction_number": "2206-A-00013"
  +"receive_id": 12
  +"po_id": 3
  +"deposit_id": 3
  +"po_bank_id": 2
  +"deposit_bank_id": 3
   --}}
                                {{-- @dd($statement) --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $statement->category_name }}</td>                                   
                                    <td>{{ $statement->operator_name }}</td>                                   
                                    <td>{{ $statement->po_number }}</td>                                   
                                    <td>{{ date('d/m/y', strtotime($statement->po_date)) }}</td>   
                                    <td>{{ $statement->po_bank_name }}</td>                                  
                                    <td>{{ $statement->po_id }}-{{ $statement->po_amount }}</td>                                  
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
