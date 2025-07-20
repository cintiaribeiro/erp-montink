<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use HasUuids;
    protected $fillable = [
        'uuid',
        'name',
        'price',
    ];

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    // 👉 define que APENAS o campo `uuid` deve receber UUID automaticamente
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
