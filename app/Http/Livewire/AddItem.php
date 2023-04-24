<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Restaurant;
use Livewire\Component;

class AddItem extends Component
{
    public $restaurant;
    public $name, $price;
    public $success;
    protected $listeners = ['forAddItem' => 'updateRestaurant'];
    public function SaveItem()
    {
        $this->validate([
            'name' => 'required',
        ]);
        Item::create([
            'name' => $this->name,
            'price' => 135,
        ]);
        $this->name = '';
        $this->price = '';
//        success message
        $this->success = 'Item added successfully';
    }
    public function render()
    {
        return view('livewire.add-item');
    }
}
