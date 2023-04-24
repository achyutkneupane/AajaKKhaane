<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class VoteForToday extends Component
{
    public $items;
    public $item = "";
    public $votesForToday;
    public $votedForToday;
    public $voteCollect;
    public $voting = false;
    public $everyoneVoted = false;

    protected $listeners = ['echo:someone-voted,SomeoneVoted' => '$refresh'];

    public function voteForToday() {
        $this->voting = true;
        $this->validate([
            'item' => 'required|exists:items,id'
        ]);

        if ($this->votedForToday) {
            $this->addError('item', 'You have already voted for today');
            return;
        }

        auth()->user()->votes()->create([
            'item_id' => $this->item,
            'voted_at' => today()
        ]);

        $this->item = "";

        event(new \App\Events\SomeoneVoted);
        $this->voting = false;
    }
    public function render()
    {
        $this->items = Item::where('is_active', true)->get();
        $this->votedForToday = auth()->user()->votes()->where('voted_at', '>=', today())->exists();
        $this->votesForToday = Vote::where('voted_at', '>=', today())->get();
//        $votables = User::get()->filter(function($user) {
//            return $user->hasPermissionTo('can vote');
//        })->count();

        $votables = User::count();

        if($this->votesForToday->count() == $votables) {
            $this->everyoneVoted = true;
        }

        $this->voteCollect = collect();
        foreach ($this->items as $item) {
            if ($this->votesForToday->where('item_id', $item->id)->count() > 0) {
                $this->voteCollect->push([
                    'item' => $item->name,
                    'votes' => $this->votesForToday->where('item_id', $item->id)->count(),
                    'voter_names' => $this->votesForToday->where('item_id', $item->id)->pluck('user.name')->map(function($name) {
                        return explode(' ', $name)[0];
                    })->implode(', '),
                    'percentage' => round($this->votesForToday->where('item_id', $item->id)->count() / $this->votesForToday->count() * 100, 2)
                ]);
            }
        }
        return view('livewire.vote-for-today');
    }
}
