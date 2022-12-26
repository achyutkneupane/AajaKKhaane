<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Aaja Kaa khaane?</div>

                <div class="card-body">
                    @if ($votedForToday)
                        <div class="list-group">
                            @foreach ($voteCollect->sortByDesc('votes') as $vote)
                                <h5 class="mb-1">{{ $vote['restaurant'] }}</h5>
                                <div class="progress mb-2" style="height: 30px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated {{ $loop->first ? 'bg-success' : 'bg-danger' }} px-3 d-flex justify-content-center align-items-center" role="progressbar" style="width: {{ $vote['percentage'] }}%;"
                                        aria-valuenow="{{ $vote['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                                        <strong class="fs-6 fw-bolder">{{ $vote['percentage'] }}%</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="mb-3">
                            @error('restaurant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="restaurant" class="form-label">Your choice</label>
                            <select class="form-select" aria-label="Select restaurant" wire:model="restaurant">
                                <option selected disabled value="">Select hotel/restaurant</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">You can vote only once a day.</div>
                        </div>
                        <button type="button" class="btn btn-primary" wire:click="voteForToday" {{ $voting ? 'disabled' : '' }}>
                            {{ $voting ? 'Voting...' : 'Vote' }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
