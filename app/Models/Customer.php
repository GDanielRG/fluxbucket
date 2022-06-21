<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static $unguarded = true;

    /**
     * Relationship
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
