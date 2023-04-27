<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">Add User</div>

                <div class="card-body">
                    <form wire:submit.prevent="addUser">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" type="text" class="form-control" id="name"
                                   aria-describedby="nameHelp">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div id="nameHelp" class="form-text">Name of the person</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input wire:model="email" type="email" class="form-control" id="email"
                                   aria-describedby="emailHelp">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div id="emailHelp" class="form-text">Email of the user</div>
                        </div>
{{--                        <div class="mb-3">--}}
{{--                            <label for="is_regular" class="form-label">Is Regular</label>--}}
{{--                            <select wire:model="is_regular" class="form-select" aria-label="Default select example">--}}
{{--                                <option value="1">Yes</option>--}}
{{--                                <option value="0">No</option>--}}
{{--                            </select>--}}
{{--                            @error('is_regular')--}}
{{--                            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                            <div id="is_regularHelp" class="form-text">Is the user a regular eater?</div>--}}
{{--                        </div>--}}
                        <div class="mb-3">
                            <label for="variant" class="form-label">Is Regular?</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="regular" id="yes" value="1" />
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="regular" id="no" value="0" />
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
