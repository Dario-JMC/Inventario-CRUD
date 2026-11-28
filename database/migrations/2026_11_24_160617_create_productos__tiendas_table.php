<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Tienda extends Model
{
    use HasFactory;

    protected $table = 'Productos__tiendas';

    protected $fillable = [
        'store_id',
        'nombre',
        'precio',
        'stock',
        'activo',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}