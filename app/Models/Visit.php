<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Restaurant
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * User
     */
    public function payer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
