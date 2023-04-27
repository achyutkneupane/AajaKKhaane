<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\User;
use App\Models\Vote;
use Livewire\Component;

class VoteForToday extends Component
{
    public $items;
    public $item = "";
    public $variant = "c";
    public $votesForToday;
    public $votedForToday;
    public $voteCollect;
    public $voting = false;
    public $votables;
    public $notEatingToggle = false;
    public $everyoneVoted = false;

    public $finalVotes;

    protected $listeners = ['echo:someone-voted,SomeoneVoted' => '$refresh'];

    public function mount()
    {
        $this->setAbsentForToday();
        $this->variant = auth()->user()->username == "madhavi" ? "v" : "c";
    }

    public function setAbsentForToday()
    {
        $users = \App\Models\User::with('logs','regular')->get();
        foreach($users as $user) {
            $absentToday = $user->logs()->whereDate('created_at', today())->first();
            if (!$absentToday) {
                if($user->isRegular()) {
                    $user->logs()->create([
                        'created_at' => today()
                    ]);
                } else {
                    $user->logs()->create([
                        'created_at' => today(),
                        'absent_at' => today(),
                    ]);
                }
            }
        }
    }

    public function voteForToday() {
        $this->voting = true;
        $this->validate([
            'item' => 'required|exists:items,id',
            'variant' => 'required|in:c,v'
        ]);

        if ($this->votedForToday) {
            $this->addError('item', 'You have already voted for today');
            return;
        }

        auth()->user()->votes()->create([
            'item_id' => $this->item,
            'voted_at' => today(),
            'variant' => $this->variant
        ]);

        $this->item = "";
        $this->variant = "";

        event(new \App\Events\SomeoneVoted);
        $this->voting = false;
    }

    public function notEatingToday()
    {
        $this->notEatingToggle = true;
        auth()->user()->logs()->whereDate('created_at', today())->update([
            'absent_at' => today()
        ]);
        $this->notEatingToggle = false;
    }

    public function render()
    {
        $this->items = Item::where('is_active', true)->get();
        $this->votedForToday = auth()->user()->votes()->where('voted_at', '>=', today())->exists();
        $this->votesForToday = Vote::where('voted_at', '>=', today())->get();
        $this->votables = User::get()->filter(function($user) {
            return !$user->notEatingToday();
        })->count();


        $countSeparate = $this->votesForToday->groupBy('variant');
        $this->finalVotes = $countSeparate->map(function($item, $key) {
            if($key == 'c') {
                $key = 'Chicken';
            } else {
                $key = 'Vegetarian';
            }
            return [
                'variant' => $key,
                'votes' => $item->count()
            ];
        })->sortByDesc('votes');


        if($this->votesForToday->count() == $this->votables) {
            $this->everyoneVoted = true;
        }

        $this->voteCollect = collect();
        foreach ($this->items as $item) {
            if ($this->votesForToday->where('item_id', $item->id)->count() > 0) {
                $this->voteCollect->push([
                    'item' => $item->name,
                    'votes' => $this->votesForToday->where('item_id', $item->id)->count(),
                    'voter_names' => $this->votesForToday->where('item_id', $item->id)->pluck('user')->map(function($user) {
                        $firstName = explode(' ', $user->name)[0];
                        $variant = $this->votesForToday->where('user_id', $user->id)->first()->variant;
                        $fullVariant = $variant == 'c' ? 'Chicken' : 'Vegetarian';
                        return $firstName . ' (' . $fullVariant . ')';
                    })->implode(', '),
                    'percentage' => round($this->votesForToday->where('item_id', $item->id)->count() / $this->votesForToday->count() * 100, 2)
                ]);
            }
        }
        $this->voteCollect = $this->voteCollect->sortByDesc('percentage');
        return view('livewire.vote-for-today');
    }
}
