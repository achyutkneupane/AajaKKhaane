<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SelectedItems extends Component
{
    public $items, $selectedItems;
    public $votables;

    protected $listeners = ['forSelectItem' => 'selectItem'];

    public function mount($items, $selectedItems)
    {
        $this->items = $items;
        $this->selectedItems = $selectedItems;
        $this->votables = User::get()->filter(function($user) {
            return $user->hasPermissionTo('can vote');
        });
    }

    public function selectItem($item)
    {
        array_push($this->selectedItems, $item);
    }

    public function render()
    {
        return view('livewire.selected-items');
    }
}
