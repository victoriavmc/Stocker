<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'inventory';

    // Especifico la clave primaria
    protected $primaryKey = 'idInventory';

    // Campos asignables en masa
    protected $fillable = [
        'maxQuantity',
        'minQuantity',
        'stock',
        'idProduct'
    ];

    // Relación recibiendo de otros modelos
    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'idProduct');
    }
}
