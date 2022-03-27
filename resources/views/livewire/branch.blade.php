<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Branch Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Branch Page</li>
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
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th style="">Routing Number</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $branch->bank->name ?? 'Not Found' }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td style="">{{ $branch->routing_number }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $branch->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $branch->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
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
                            <h4 class="modal-title" id="">Branch Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit" id="branch_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter branch name here">
                                            <label for="name">Name</label>
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="routing_number" wire:model="routing_number" placeholder="Routing number">
                                            <label for="routing_number">Routing Number</label>
                                        </div>
                                        @error('routing_number')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3" wire:ignore>
                                            <select style="width: 100%;" class="form-control select2" id="bank_id" wire:model="bank_id">
                                                <option value="">Chose bank</option>
                                                @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="bank_id">Chose bank</label>
                                        </div>
                                        @error('bank_id')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                dropdownParent: $('#branch_form'),
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
