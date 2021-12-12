<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment Receive Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Payment Receive Page</li>
                </ol>
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>Create New</button>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($form)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Other Sample form</h4>
                    </div>
                    <form wire:submit.prevent="submit">
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">License category</label>
                                            <select wire:model="license_category_id" class="form-control form-select">
                                                <option value="">Chose license category</option>
                                                @foreach ($licenseCategories as $licenseCategory)
                                                <option value="{{ $licenseCategory->id }}">{{ $licenseCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">License sub category</label>
                                            <select wire:model="license_sub_category_id" class="form-control form-select">
                                                <option value="">Chose license sub category</option>
                                                @foreach ($licenseSubCategories as $licenseSubCategory)
                                                <option value="{{ $licenseSubCategory->id }}">{{ $licenseSubCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Operator</label>
                                            <select wire:model="operator_id" class="form-control form-select">
                                                <option value="">Chose loperator</option>
                                                @foreach ($operators as $operator)
                                                <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Receivable Amount</label>
                                            <input wire:model="receivable_amount" type="text" id="" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Receive Date</label>
                                            <input wire:model="receive_date" type="text" id="" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Receive Amount</label>
                                            <input wire:model="receive_amount" type="text" id="" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Receive VAT</label>
                                            <input wire:model="receive_vat" type="text" id="" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="form-label">Late Fee</label>
                                            <input wire:model="receive_let_fee" type="text" id="" class="form-control form-control-danger" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i> Add</button>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table success-table">
                            <thead>
                                <tr>
                                    <th>Received Fee</th>
                                    <th>Received Period</th>
                                    <th>Received Amount</th>
                                    <th>Payment Date</th>
                                    <th>Received Date</th>
                                    <th>Delay Dayes </th>
                                    <th>Received VAT</th>
                                    <th>Received Late Fee</th>
                                    <th>Received Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentReceives as $paymentReceive)
                                <tr>
                        
                                    <td>{{ '@' }}</td>
                                    <td>{{ '@' }}</td>
                                    <td>{{ $paymentReceive->receive_amount }}</td>
                                    <td>{{ '@' }}</td>
                                    <td>{{ $paymentReceive->receive_date }}</td>
                                    <td>{{ '@' }}</td>
                                    <td>{{ $paymentReceive->receive_vat }}</td>
                                    <td>{{ $paymentReceive->receive_let_fee }}</td>
                                    <td>{{ '@' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="selectForEdit({{ $paymentReceive->id }})">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="selectForDelete({{ $paymentReceive->id }})" onclick="openModal()"> Delete </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
         <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt="Delete"> <br>
         <button type="button" class="btn btn-danger text-white" wire:click="destroy" onclick="closeModal()"> Confirm Delete </button>
         <button type="button" class="btn btn-secondary close-btn" onclick="closeModal()">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function openModal() {
        $('#delete_modal').modal('show');
    }
    function closeModal() {
        $('#delete_modal').modal('hide');
    } 
</script>
</div>