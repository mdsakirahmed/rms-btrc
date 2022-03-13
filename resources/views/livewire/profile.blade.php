<div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Profile Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Profile Page</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Profile information</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="info_update">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control bg-success text-white" id="name" wire:model="name" placeholder="Full name">
                                    <label for="name">Full Name</label>
                                </div>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input required type="email" class="form-control bg-success text-white" id="email" wire:model="email" placeholder="Email Address">
                                    <label for="email">Email Address</label>
                                </div>
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn w-50 btn-lg btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Profile security</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="password_update">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input required type="password" class="form-control @if($old_password_correct) bg-success @else bg-danger @endif text-white" id="old_password" wire:model="old_password" placeholder="Old password">
                                    <label for="old_password">Old password</label>
                                </div>
                                @error('old_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @if($password_message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $password_message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input required type="password" class="form-control @if($new_and_confirm_password_are_same) bg-success @else bg-danger @endif text-white" id="new_password" wire:model="new_password" placeholder="New password">
                                    <label for="new_password">New password</label>
                                </div>
                                @error('new_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input required type="password" class="form-control @if($new_and_confirm_password_are_same) bg-success @else bg-danger @endif text-white" id="confirm_password" wire:model="confirm_password" placeholder="Confirm password">
                                    <label for="confirm_password">Confirm password</label>
                                </div>
                                @error('confirm_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn w-50 btn-lg btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
