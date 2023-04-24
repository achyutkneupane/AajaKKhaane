<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BillSplit extends Component
{
    public $users,$restaurants,$winner,$winnerId;
    public $selectedItems = [], $items;
    public $showAddItem;

    protected $rules = [
        'selectedItems' => 'required',
        'winner' => 'required',
    ];

    protected $listeners = ['updateItems' => 'setShowAddItemFalse'];

    public function mount()
    {
        $this->winnerId = \App\Models\Restaurant::withCount('votes')->whereHas('votes', function($query) {
            $query->where('voted_at', '>=', date('Y-m-d 00:00:00'))
                  ->where('voted_at', '<=', date('Y-m-d 23:59:59'));
        })->orderBy('votes_count', 'desc')->firstOrFail()->id;
    }
    public function updated($propertyName)
    {
        if($propertyName == 'winnerId') {
            $this->winner = \App\Models\Restaurant::find($this->winnerId);
            $this->items = $this->winner->items;
            $this->emitTo('add-item','forAddItem', $this->winner);
        }
    }
    public function setShowAddItemFalse()
    {
        $this->showAddItem = false;
    }

    public function selectItem($id)
    {
        array_push($this->selectedItems, $id);
        $this->emitTo('selected-items','forSelectItem', $id);
    }
    public function render()
    {
        $this->winner = \App\Models\Restaurant::find($this->winnerId);
        $this->items = $this->winner->items;
        $this->users = \App\Models\User::get();
        $this->restaurants = \App\Models\Restaurant::get();
        return view('livewire.bill-split');
    }
}
