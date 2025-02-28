<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders(): HasMany {
        return  $this->hasMany(Order::class);
    }
}
