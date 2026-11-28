<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Productos_Tienda extends Model
{
    protected $fillable = [
        'store_id',
        'nombre',
        'precio',
        'stock',
        'activo',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}