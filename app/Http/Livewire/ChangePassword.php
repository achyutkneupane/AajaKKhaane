<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'old_password' => 'required',
        'new_password' => 'required|confirmed|different:old_password',
    ];

    public function changePassword()
    {
        $this->validate();
        if(!Hash::check($this->old_password, auth()->user()->password)) {
            $this->addError('old_password', 'Old password is incorrect');
            return;
        }
        auth()->user()->update([
            'password' => Hash::make($this->new_password)
        ]);
        $this->reset();
        session()->flash('success', 'Password changed successfully');
    }
    public function render()
    {
        return view('livewire.change-password');
    }
}
