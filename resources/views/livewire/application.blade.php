<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Application Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Application Page</li>
                </ol>
                <button type="button" wire:click="create" class="btn btn-dark d-none d-lg-block m-l-15" alt="default" data-bs-toggle="modal" data-bs-target=".application-modal"><i class="fa fa-plus-circle"></i> Create New</button>
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
                                    <th style="text-align: right;">Application Fee</th>
                                    <th style="text-align: right;">Processing Fee</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $application->name }} &nbsp;
                                        @if( $application->approved)
                                        <button type="button" class="btn waves-effect waves-light btn-xs text-white btn-info" data-bs-toggle="modal" data-bs-target=".reject-modal" wire:click="select_for_change_approval({{ $application->id }})">Approve</button>
                                        @else
                                            <button type="button" class="btn waves-effect waves-light btn-xs text-white btn-danger" data-bs-toggle="modal" data-bs-target=".approve-modal" wire:click="select_for_change_approval({{ $application->id }})">Approve</button>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">{{ $application->application_fee }} ৳</td>
                                    <td style="text-align: right;">{{ $application->processing_fee }} ৳</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $application->id }})" data-bs-toggle="modal" data-bs-target=".application-modal">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="select_for_delete({{ $application->id }})" data-bs-toggle="modal" data-bs-target=".delete-modal"> Delete </button>
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
            <!-- application modal content -->
            <div wire:ignore.self class="modal application-modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h4 class="modal-title" id="">Application Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Enter Name here">
                                            <label for="name">Name</label>
                                        </div>
                                        <x-error name="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="application_fee" wire:model="application_fee" placeholder="Application fee">
                                            <label for="application_fee">Application Fee</label>
                                        </div>
                                        <x-error name="application_fee" />
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="processing_fee" wire:model="processing_fee" placeholder="Processing fee">
                                            <label for="processing_fee">Processing Fee</label>
                                        </div>
                                        <x-error name="processing_fee" />
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
                </div>
            </div>
            <!-- /.modal -->
            <!-- delete modal content -->
            <div wire:ignore.self class="modal delete-modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('assets/images/delete-animation.gif') }}" width="200" alt=""> <br>
                            <button class="btn btn-danger text-white" data-bs-dismiss="modal" wire:click="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
            <!-- approve modal content -->
            <div wire:ignore.self class="modal approve-modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('assets/images/approved.png') }}" width="200" alt=""> <br>
                            <p>*This application is not approved. Click bellow to approve.</p>
                            <button class="btn btn-success text-white" data-bs-dismiss="modal" wire:click="change_approval">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
            <!-- approve modal content -->
            <div wire:ignore.self class="modal reject-modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="{{ asset('assets/images/reject.png') }}" width="200" alt=""> <br>
                            <p>*This application is approved. Click bellow to reject.</p>
                            <button class="btn btn-danger text-white" data-bs-dismiss="modal" wire:click="change_approval">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </div>
    </div>
</div>
