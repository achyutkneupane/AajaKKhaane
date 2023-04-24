<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminPanel extends Component
{
    public $users;
//    public function togglePermission($user, $permission)
//    {
//        $user = \App\Models\User::find($user);
//        if ($user->hasPermissionTo($permission)) {
//            $user->revokePermissionTo($permission);
//        } else {
//            $user->givePermissionTo($permission);
//        }
//    }
    public function toggleAbsentLog(User $user)
    {
        if ($user->logs()->whereDate('absent_at', today())->exists()) {
            $user->logs()->whereDate('absent_at', today())->delete();
        } else {
            $user->logs()->create([
                'created_at' => today()
            ]);
        }
    }

    public function notEatingToday(User $user)
    {
        return $user->logs()->whereDate('absent_at', today())->exists();
    }

    public function render()
    {
        $this->users = \App\Models\User::get()->map(function ($user) {
            $user->eatingToday = !$this->notEatingToday($user);
            return $user;
        });
        return view('livewire.admin-panel');
    }
}
