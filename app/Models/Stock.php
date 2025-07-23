<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'variation',
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
