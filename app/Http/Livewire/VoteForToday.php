<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use App\Models\Vote;
use Livewire\Component;

class VoteForToday extends Component
{
    public $restaurants;
    public $restaurant = "";
    public $votesForToday;
    public $votedForToday;
    public $voteCollect;
    // mount
    public function mount()
    {
        $this->restaurants = Restaurant::where('is_active', true)->get();
    }
    public function voteForToday() {
        $this->validate([
            'restaurant' => 'required|exists:restaurants,id'
        ]);

        if ($this->votedForToday) {
            $this->addError('restaurant', 'You have already voted for today');
            return;
        }

        auth()->user()->votes()->create([
            'restaurant_id' => $this->restaurant,
            'voted_at' => today()
        ]);

        $this->restaurant = "";
    }
    public function render()
    {
        $this->votedForToday = auth()->user()->votes()->where('voted_at', '>=', today())->exists();
        $this->votesForToday = Vote::where('voted_at', '>=', today())->get();
        $this->voteCollect = collect();
        foreach ($this->restaurants as $restaurant) {
            if ($this->votesForToday->where('restaurant_id', $restaurant->id)->count() > 0) {
                $this->voteCollect->push([
                    'restaurant' => $restaurant->name,
                    'votes' => $this->votesForToday->where('restaurant_id', $restaurant->id)->count(),
                    'percentage' => $this->votesForToday->where('restaurant_id', $restaurant->id)->count() / $this->votesForToday->count() * 100
                ]);
            }
        }
        return view('livewire.vote-for-today');
    }
}
