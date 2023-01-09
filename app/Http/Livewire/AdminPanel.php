<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminPanel extends Component
{
    public $users;
    public function togglePermission($user, $permission)
    {
        $user = \App\Models\User::find($user);
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
        } else {
            $user->givePermissionTo($permission);
        }
    }
    public function render()
    {
        $this->users = \App\Models\User::get();
        return view('livewire.admin-panel');
    }
}
