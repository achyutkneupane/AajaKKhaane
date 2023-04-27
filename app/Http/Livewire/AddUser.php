<?php

namespace App\Http\Livewire;

use App\Mail\UserCreated;
use App\Models\Regular;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AddUser extends Component
{
    public $email;
    public $name;
    public $regular = 1;

    protected $rules = [
        'email' => 'required|email|unique:users',
        'name' => 'required'
    ];

    public function addUser()
    {
        $this->validate();
        $username = strtolower(explode(' ', $this->name)[0]);
        $username = \App\Models\User::where('username', $username)->exists() ? $username . \App\Models\User::where('username', $username)->first()->id : $username;
        $user = \App\Models\User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make('password'),
            'username' => $username
        ]);
        Regular::create([
            'user_id' => $user->id,
            'created_at' => today()
        ]);
        Mail::to($this->email, $this->name)->queue(new UserCreated($this->name, $this->email, 'password'));
        $this->reset();
    }

    public function render()
    {
        return view('livewire.add-user');
    }
}
