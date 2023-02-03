<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BillSplit extends Component
{
    public $users,$restaurants,$restaurant, $items;
    public function mount()
    {
        // for today
        $this->restaurant = \App\Models\Restaurant::withCount('votes')->whereHas('votes', function($query) {
            $query->where('voted_at', '>=', date('Y-m-d 00:00:00'))
                  ->where('voted_at', '<=', date('Y-m-d 23:59:59'));
        })->orderBy('votes_count', 'desc')->first()->id;
        $this->items = \App\Models\Restaurant::find($this->restaurant)->items;
    }
    public function updated($propertyName)
    {
        if($propertyName == 'restaurant') {
            $this->items = \App\Models\Restaurant::find($this->restaurant)->items;
        }
    }
    public function render()
    {
        $this->users = \App\Models\User::get();
        $this->restaurants = \App\Models\Restaurant::get();
        return view('livewire.bill-split');
    }
}
