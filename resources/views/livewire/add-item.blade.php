<div class="card mt-3">
    <div class="card-header">Add Item for {{ $restaurant->name }}</div>

    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" wire:model="price">
        </div>
        <button type="button" class="btn btn-primary" wire:click="SaveItem">Save</button>
    </div>
</div>