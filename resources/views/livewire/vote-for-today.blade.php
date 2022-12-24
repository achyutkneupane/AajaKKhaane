<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vote for Today</div>

                <div class="card-body">
                    @if($votedForToday)
                        <div class="list-group">
                            @foreach($voteCollect->sortByDesc('votes') as $vote)
                                <div href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $vote['restaurant'] }}</h5>
                                        <small>{{ $vote['votes'] }} vote{{ $vote['votes'] > 1 ? 's' : '' }}</small>
                                        <div>{{ $vote['percentage'] }}%</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="mb-3">
                        @error('restaurant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="restaurant" class="form-label">Your choice {{ $restaurant }} </label>
                        <select class="form-select" aria-label="Select restaurant" wire:model="restaurant">
                            <option selected disabled value="">Select hotel/restaurant</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">You can vote only once a day.</div>
                    </div>
                    <button type="button" class="btn btn-primary" wire:click="voteForToday">Vote</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>