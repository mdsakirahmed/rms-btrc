<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Activity Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Activity Page</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <p align="right">
            <button type="button" class="btn btrc" wire:click="export_as_pdf">Export as PDF</button>
            <button type="button" class="btn btrc" wire:click="export_as_excel">Export as EXCEL</button>
          </p>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table color-table">
                            <thead class="btrc">
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Message</th>
                                    {{-- <th>Data</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->causer->name ?? 'Not Found' }}</td>
                                    <td>{{ $activity->log_name }}</td>
                                    <td>{{ $activity->description }}</td>
                                    {{-- <td>{{ $activity->subject ?? collect($activity->getExtraProperty('record') ?? 'Not Found') }}</td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($activities->hasPages())
                        <div class="pagination-wrapper">
                            {{ $activities->links('pagination::bootstrap-4') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
