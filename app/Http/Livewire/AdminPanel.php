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

    public function toggleRegular(User $user)
    {
        if ($user->regular()->exists()) {
            $user->regular()->delete();
        } else {
            $user->regular()->create([
                'created_at' => today()
            ]);
        }
    }

    public function render()
    {
        $this->users = \App\Models\User::with('logs','regular')->get()->map(function ($user) {
            $user->eatingToday = !$user->notEatingToday();
            return $user;
        });
        return view('livewire.admin-panel');
    }
}
