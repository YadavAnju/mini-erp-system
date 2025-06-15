<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'total_amount',
        'status',
    ];

    public function items()
    {
    return $this->hasMany(SalesOrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
