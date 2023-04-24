<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Not Eating Logs</div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach ($users as $user)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div class="d-flex flex-column justify-content-start">
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <div>
                                        {{-- button whether 'can vote' or 'cant vote' --}}
                                        <button type="button" class="btn btn-sm {{ $user->eatingToday ? 'btn-success' : 'btn-danger' }}" wire:click="toggleAbsentLog({{ $user }})">
                                            {{ $user->eatingToday ? 'Eating' : 'Not Eating' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
