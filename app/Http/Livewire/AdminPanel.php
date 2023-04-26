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

    public function mount() {
        $this->users = \App\Models\User::with('logs','regular')->get();
        foreach($this->users as $user) {
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
    public function toggleAbsentLog(User $user)
    {
//        if (->exists()) {
//            $user->logs()->whereDate('absent_at', today())->update([
//                'absent_at' => null
//            ]);
//        } else {
//            $user->logs()->create([
//                'created_at' => today()
//            ]);
//        }
        $todaysLog = $user->logs()->whereDate('created_at', today());
        if ($todaysLog->exists()) {
            if($todaysLog->first()->absent_at) {
                $todaysLog->update([
                    'absent_at' => null
                ]);
            } else {
                $todaysLog->update([
                    'absent_at' => today()
                ]);
            }
        } else {
            $user->logs()->create([
                'created_at' => today(),
                'absent_at' => today(),
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
        $this->users = $this->users->map(function ($user) {
            $user->eatingToday = !$user->notEatingToday();
            return $user;
        });
        return view('livewire.admin-panel');
    }
}
