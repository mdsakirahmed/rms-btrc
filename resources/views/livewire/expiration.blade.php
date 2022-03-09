<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Expiration Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Expiration Page</li>
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
                                    <th>Starting Date</th>
                                    <th>Ending Date</th>
                                    <th style="text-align: right;">Total Price</th>
                                    <th style="text-align: right;">Total Iteration</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expirations as $expiration)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $expiration->starting_date }}</td>
                                    <td>{{ $expiration->ending_date }}</td>
                                    <td style="text-align: right;">{{ $expiration->total_price }} ৳</td>
                                    <td style="text-align: right;">{{ $expiration->total_iteration }}</td>
                                    <td style="text-align: center;">
                                        @if($expiration->payments()->where('paid', true)->count() > 0)
                                        <i class="text-danger">{{ $expiration->payments()->where('paid', true)->count() }} payments</i>
                                        @else
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $expiration->id }})" alt="default" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
                                        <button type="button" class="btn btn-danger text-white" wire:click="delete({{ $expiration->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()"> Delete </button>
                                        @endif
                                        <br>
                                        <button type="button" class="btn btn-success btn-sm text-white" wire:click="download_payment_schedule({{ $expiration->id }})"> Download Payment Schedule </button>
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
                            <h4 class="modal-title" id="">Expiration Form</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="starting_date" wire:model="starting_date" placeholder="">
                                            <label for="starting_date">Starting date</label>
                                        </div>
                                        @error('starting_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="ending_date" wire:model="ending_date" placeholder="">
                                            <label for="ending_date">Ending date</label>
                                        </div>
                                        @error('ending_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="total_price" wire:model="total_price" placeholder="Total price">
                                            <label for="total_price">Total price</label>
                                        </div>
                                        @error('total_price')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="total_iteration" wire:model="total_iteration" placeholder="Total iteration">
                                            <label for="total_iteration">Total iteration</label>
                                        </div>
                                        @error('total_iteration')
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
</div>
