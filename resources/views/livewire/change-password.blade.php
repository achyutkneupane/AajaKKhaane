<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                    <div class="card-header">Change Password</div>

                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form wire:submit.prevent="changePassword">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input wire:model="old_password" type="password" class="form-control" id="old_password"
                                    aria-describedby="old_passwordHelp">
                                @error('old_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div id="old_passwordHelp" class="form-text">Old Password</div>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input wire:model="new_password" type="password" class="form-control" id="new_password"
                                    aria-describedby="new_passwordHelp">
                                @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div id="new_passwordHelp" class="form-text">New Password</div>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input wire:model="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation"
                                    aria-describedby="new_password_confirmationHelp">
                                @error('new_password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div id="new_password_confirmationHelp" class="form-text">Confirm New Password</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
