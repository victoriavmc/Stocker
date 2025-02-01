<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryData extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'inventorydata';

    // Especifico la clave primaria
    protected $primaryKey = 'idInventoryData';

    // Campos asignables en masa
    protected $fillable = [
        'quantity',
        'price',
        'totalMovement',
        'idProduct'
    ];

    // Relación recibiendo de otros modelos
    public function product()
    {
        return $this->belongsTo(Products::class, 'idProduct', 'idProduct');
    }

    //Relacion enviando a otros modelos
    public function archivists()
    {
        return $this->hasMany(Archivist::class, 'idInventoryData', 'idInventoryData');
    }

}
