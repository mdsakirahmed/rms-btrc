<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard Card</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard Card</li>
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
                                <th>Title</th>
                                <th>Value</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <td>{{ $card->id }}</td>
                                    <td>{{ $card->title }}</td>
                                    <td>{{ $card->value }}</td>
                                    <td style="background-color: {{ $card->color }}">{{ $card->color }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" wire:click="select_for_edit({{ $card->id }})" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</button>
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
    <!-- sample modal content -->
    <div wire:ignore.self class="modal bs-example-modal-lg fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title" id="">Dashboard Card</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="title" wire:model="title" placeholder="Enter Title">
                                    <label for="title">Title</label>
                                </div>
                                <x-error name="title" />
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="value" wire:model="value" placeholder="Enter Value">
                                    <label for="value">Value</label>
                                </div>
                                <x-error name="value" />
                            </div>
                            <div class="col-md-4">
                                <label for="color">Color</label> <br>
                                <input type="color" class="" id="color" wire:model="color" placeholder="Enter Color">
                                <x-error name="color" />
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
