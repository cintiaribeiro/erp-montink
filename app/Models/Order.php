<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'uuid',
        'number',
        'coupon_id',
        'freight',
        'subtotal',
        'total',
        'status',
        'name_client',
        'email_client',
        'payment_method'
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatus()
    {
        switch ($this->status){
            case 1: return 'Em processo';
        }
    }
}
