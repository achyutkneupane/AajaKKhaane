<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Aaja K khaane?</div>

                <div class="card-body">
                    @if($everyoneVoted)
                        <div class="text-center">
                            <h2>
                                Winner: <span class="text-success">{{ $voteCollect->first()['item'] }}</span> <br>
                            </h2>
                        </div>
                    @else
{{--                        @if ($votedForToday || !auth()->user()->hasPermissionTo('can vote'))--}}
                        @if ($votedForToday)
{{--                            @if (!auth()->user()->hasPermissionTo('can vote'))--}}
{{--                            <div class="alert alert-warning">--}}
{{--                                You don't have permission to vote.--}}
{{--                            </div>--}}
{{--                            @else--}}
                            <div class="list-group">
                                @foreach ($voteCollect->sortByDesc('votes') as $vote)
                                    <h5 class="mb-1">{{ $vote['item'] }}</h5>
                                    <div class="progress mb-2" style="height: 30px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated {{ $loop->first ? 'bg-success' : 'bg-danger' }} px-3 d-flex justify-content-center align-items-center" role="progressbar" style="width: {{ $vote['percentage'] }}%;"
                                            aria-valuenow="{{ $vote['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                                            <strong class="fs-6 fw-bolder">{{ $vote['percentage'] }}%</strong>
                                        </div>
                                    </div>
                                    <div class="text-muted mb-3">
                                        {{ $vote['voter_names'] }}
                                    </div>
                                @endforeach
                            </div>
{{--                            @endif--}}
                        @else
                            <div class="mb-3">
                                @error('item')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="item" class="form-label">Your choice</label>
                                <select class="form-select" aria-label="Select item" wire:model="item">
                                    <option selected disabled value="">Select item</option>
                                    @foreach ($items as $loopItem)
                                        <option value="{{ $loopItem->id }}">{{ $loopItem->name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">You can vote only once a day.</div>
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="voteForToday" {{ $voting ? 'disabled' : '' }}>
                                {{ $voting ? 'Voting...' : 'Vote' }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>

             <div class="text-center mt-3">
                @if (auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin-panel') }}" class="btn btn-link">Admin Panel</a>
                @endif
            </div>
        </div>
    </div>
</div>
