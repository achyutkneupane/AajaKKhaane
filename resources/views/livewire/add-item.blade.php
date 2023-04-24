<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">Add Item</div>

                <form class="card-body" wire:submit.prevent="SaveItem">
                    @if($success)
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                    </div>
                    <button type="button" class="btn btn-primary" wire:click="SaveItem">Save</button>
                </form>
            </div>


            <div class="mt-3">
                <h3>Items</h3>
                <ol class="list-group list-group-numbered">
                    @foreach($items as $item)
                        <li>
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
