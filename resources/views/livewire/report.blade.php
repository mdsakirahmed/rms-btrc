<div>
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
                <button type="button" class="btn btn-dark d-none d-lg-block m-l-15" wire:click="showForm"><i class="fa fa-plus-circle"></i>
                    Create New</button>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @livewire('charts.month-wise-payble-and-paid-amount', ['cdn' => 1])
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Example Document" wire:model="name">
                                <x-error name="name" />
                            </div>
                          <div class="form-group col-md-6">
                            <label for="file">File</label>
                            <input type="file" class="form-control" id="file" wire:model="file">
                            <x-error name="file" />
                          </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </form>
                </div>
            </div>
        </div>
    </div>


</div>
