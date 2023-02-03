<?php

namespace App\Http\Livewire;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;

class VoteForToday extends Component
{
    public $restaurants;
    public $restaurant = "";
    public $votesForToday;
    public $votedForToday;
    public $voteCollect;
    public $voting = false;
    public $everyoneVoted = false;

    protected $listeners = ['echo:someone-voted,SomeoneVoted' => '$refresh'];

    public function voteForToday() {
        $this->voting = true;
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

        event(new \App\Events\SomeoneVoted);
        $this->voting = false;
    }
    public function render()
    {
        $this->restaurants = Restaurant::where('is_active', true)->get();
        $this->votedForToday = auth()->user()->votes()->where('voted_at', '>=', today())->exists();
        $this->votesForToday = Vote::where('voted_at', '>=', today())->get();
        $votables = User::get()->filter(function($user) {
            return $user->hasPermissionTo('can vote');
        })->count();

        if($this->votesForToday->count() == $votables) {
            $this->everyoneVoted = true;
        }

        $this->voteCollect = collect();
        foreach ($this->restaurants as $restaurant) {
            if ($this->votesForToday->where('restaurant_id', $restaurant->id)->count() > 0) {
                $this->voteCollect->push([
                    'restaurant' => $restaurant->name,
                    'votes' => $this->votesForToday->where('restaurant_id', $restaurant->id)->count(),
                    'voter_names' => $this->votesForToday->where('restaurant_id', $restaurant->id)->pluck('user.name')->map(function($name) {
                        return explode(' ', $name)[0];
                    })->implode(', '),
                    'percentage' => round($this->votesForToday->where('restaurant_id', $restaurant->id)->count() / $this->votesForToday->count() * 100, 2)
                ]);
            }
        }
        return view('livewire.vote-for-today');
    }
}
