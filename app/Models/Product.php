<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity',
    ];

    public function orderItems()
    {
    return $this->hasMany(SalesOrderItem::class);
    }

}
