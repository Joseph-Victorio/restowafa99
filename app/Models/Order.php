<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['meja_id', 'total_harga', 'status',  'snap_token',];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
