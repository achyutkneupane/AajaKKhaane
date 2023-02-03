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
                        <label for="restaurant" class="form-label">We went</label>
                        <select class="form-select" aria-label="Select restaurant" wire:model="restaurant">
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
                        <select class="form-select" aria-label="Select items" wire:model="items" id="itemsSelect">
                            <option selected disabled value="">Select items</option>
                            @forelse ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
                                <option value="">No items available</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
