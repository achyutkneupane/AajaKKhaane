<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function visitPayments()
    {
        return $this->hasMany(Visit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Votes
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Not Eating Logs
     */
    public function logs()
    {
        return $this->hasMany(AbsentLog::class);
    }

    public function regular()
    {
        return $this->hasOne(Regular::class);
    }

    public function isRegular()
    {
        return $this->regular()->exists();
    }

    public function notEatingToday()
    {
        if($this->isRegular()) {
            return $this->logs()->whereDate('absent_at', today())->exists();
        } else {
            return true;
        }
    }


}
