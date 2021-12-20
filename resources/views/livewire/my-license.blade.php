<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">License Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">License Page</li>
                </ol>
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
                                    <th>License</th>
                                    <th>Expire Date</th>
                                    <th>Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenses as $license)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $license->license_number }}</td>
                                    <td>{{ $license->expire_date }}</td>
                                    <td>{{ $license->fee}}/{{ $license->instalment }}</td>
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
