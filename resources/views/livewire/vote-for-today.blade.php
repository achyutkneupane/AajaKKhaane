<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Aaja K khaane?</div>

                <div class="card-body">
                    @if(auth()->user()->notEatingToday())
                        <div class="text-center">
                            <h5>
                                Not Eating Today
                            </h5>
                        </div>
                    @else
                        @if($everyoneVoted)
                            <div class="text-center mt-3">
                                <h2>
                                    Today we are eating: <span class="text-success">{{ $voteCollect->first()['item'] }}</span> <br>
                                </h2>
                            </div>

                            <div class="my-3 text-muted text-center">
                                @foreach($finalVotes as $finalVote)
                                    <div>
                                        {{ $finalVote['variant'] }}: {{ $finalVote['votes'] }}
                                    </div>
                                @endforeach
                                <div>
                                    Total: <b>{{ $finalVotes->sum('votes') }}</b>
                                </div>
                            </div>
                        @else

                            <div class="my-3 text-muted text-center">
                                Total Voters for today: {{ $votesForToday->count() }}/{{ $votables }}
                            </div>
                            @if ($votedForToday)
                                <div class="list-group">
                                    @foreach ($voteCollect as $vote)
                                        <h5 class="mb-1">{{ $vote['item'] }}</h5>
                                        <div class="progress mb-2" style="height: 30px;">
                                            <div
                                                class="progress-bar progress-bar-striped progress-bar-animated {{ $loop->first ? 'bg-success' : 'bg-danger' }} px-3 d-flex justify-content-center align-items-center"
                                                role="progressbar" style="width: {{ $vote['percentage'] }}%;"
                                                aria-valuenow="{{ $vote['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <strong class="fs-6 fw-bolder">{{ $vote['percentage'] }}%</strong>
                                            </div>
                                        </div>
                                        <div class="text-muted mb-3">
                                            {{ $vote['voter_names'] }}
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mb-3">
                                    @error('item')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div wire:ignore>
                                        <label for="item" class="form-label">Your choice</label>
                                        <select class="form-select" aria-label="Select item" id="select2">
                                            <option selected disabled value="">Select item</option>
                                            @foreach ($items as $loopItem)
                                                <option value="{{ $loopItem->id }}">{{ $loopItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="variant" class="form-label">Your Variant</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model="variant" id="chicken" value="c" />
                                                <label class="form-check-label" for="chicken">Chicken</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model="variant" id="vegetarian" value="v" />
                                                <label class="form-check-label" for="vegetarian">Vegetarian</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-text fs-5">
                                        प्लिज वाश योर ओन् टिफिन बक्स
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary"
                                        wire:click="voteForToday" {{ $voting ? 'disabled' : '' }}>
                                    {{ $voting ? 'Voting...' : 'Vote' }}
                                </button>
                                @if(auth()->user()->isRegular())
                                    <button type="button" class="btn btn-danger"
                                            wire:click="notEatingToday" {{ $notEatingToggle ? 'disabled' : '' }}>
                                        {{ $notEatingToggle ? 'Submitting...' : 'Not Eating' }}
                                    </button>
                                @endif
                            @endif
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

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            const select2Elem = $('#select2');
            select2Elem.select2();
            select2Elem.on('change', function (e) {
                var data = $('#select2').select2("val");
                @this.set('item', data);
            });
        });
    </script>
@endpush
