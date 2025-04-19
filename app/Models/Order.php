<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total',    // Add 'total' to the fillable array
        'status',   // Include other fillable fields if necessary
        'user_id',
        // Add other fields here if needed
    ];
    public function items() { return $this->hasMany(OrderItem::class); }
    public function user() { return $this->belongsTo(User::class); }

}
