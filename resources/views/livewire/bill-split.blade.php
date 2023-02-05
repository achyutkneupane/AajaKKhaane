<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bill Split for today</div>

                <div class="card-body">
                    {{-- select --}}
                    <div class="mb-3">
                        @error('restaurant')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="restaurant" class="form-label">We went {{ $winner->name }}</label>
                        <select class="form-select" aria-label="Select restaurant" wire:model="winnerId">
                            <option selected disabled value="">Select hotel/restaurant</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- items --}}
                    <div class="mb-3">
                        @error('items')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="items" class="form-label">We ordered</label>
                        (<span wire:click="$toggle('showAddItem')" role="button" class="text-primary">
                            {{ $showAddItem ? 'Hide Add' : 'Add' }} item
                        </span>)
                        @forelse ($items as $item)
                            <div key="item-{{ $item->id }}">
                                {{ $item->name }} - Rs. {{ $item->price }}
                                (<span wire:click="selectItem({{ $item->id }})" class="text-primary">Select</span>)
                            </div>
                        @empty
                            <div class="alert alert-warning">No items found</div>
                        @endforelse
                    </div>
                </div>
            </div>
            @if($showAddItem)
            @livewire('add-item', ['restaurant' => $winner])
            @endif

            @if(count($selectedItems))
            @livewire('selected-items', ['items' => $items, 'selectedItems' => $selectedItems])
            @endif
        </div>
    </div>
</div>

@push('scripts')
@endpush
