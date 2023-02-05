<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use Livewire\Component;

class AddItem extends Component
{
    public $restaurant;
    public $name, $price;
    protected $listeners = ['forAddItem' => 'updateRestaurant'];
    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }
    public function updateRestaurant(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }
    public function SaveItem()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $this->restaurant->items()->create([
            'name' => $this->name,
            'price' => $this->price,
        ]);
        $this->emitTo('bill-split','updateItems');
        $this->name = '';
        $this->price = '';
    }
    public function render()
    {
        return view('livewire.add-item');
    }
}
