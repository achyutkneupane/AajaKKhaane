<div class="card mt-3">
    <div class="card-header">Selected Items</div>
        {{-- show item name, price(input), quantity(input), checkbox with first names of all votables in a table --}}
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Eaten by</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedItems as $selectedItem)
                        @php
                            $item = $items->where('id', $selectedItem)->first();
                        @endphp
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <input type="number" class="form-control" id="quantity-{{ $item->id }}"
                                    wire:model="price.{{ $item->id }}">
                            </td>
                            <td>
                                <input type="number" class="form-control" id="quantity-{{ $item->id }}"
                                    wire:model="quantities.{{ $item->id }}">
                            </td>
                            <td>
                            @foreach ($votables as $votable)
                                @php
                                    $name = explode(' ', $votable->name);
                                    $name = $name[0];
                                @endphp
                                <input class="form-check-input" type="checkbox" value="{{ $votable->id }}"
                                    id="votable-{{ $votable->id }}" wire:model="votables.{{ $item->id }}">
                                    <label class="form-check-label" for="votable-{{ $votable->id }}">
                                        {{ $name }}
                                    </label>
                                <br />
                            @endforeach
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
