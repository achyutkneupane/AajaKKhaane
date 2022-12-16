<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Food Items
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Visits
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
