<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payment History</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Payment History</li>
                </ol>
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
                                    <th>Transaction ID</th>
                                    <th>Operator</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>
                                        <a href="{{ route('payment_receipt', $payment) }}" target="_blank">{{ $payment->transaction }}</a>
                                    </td>
                                    <td>{{ $payment->operator->name ?? 'Not Found' }}</td>
                                    <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if($payment->created_at->diffInDays()>3)
                                        <p class="text-danger">Action Disabled 
                                            @else
                                        <a href="{{ route('payment-edit', $payment) }}" class="btn btn-warning">Edit</a>
                                                <button type="button" class="btn btn-danger text-white" wire:click="select_for_delete({{ $payment->id }})" data-bs-toggle="modal" data-bs-target=".delete-modal"> Delete </button>
                                        @endif
                                    </td>
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
        </div>
    </div>
</div>
