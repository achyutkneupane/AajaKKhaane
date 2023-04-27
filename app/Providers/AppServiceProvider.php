<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('users')) {
            $this->setAbsentForToday();
        }
    }

    /**
     * Register daily absents
     */
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
}
