<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'products';

    // Especifico la clave primaria
    protected $primaryKey = 'idProduct';

    // Campos asignables en masa
    protected $fillable = [
        'idBaseProduct',
        'code',
        'measure',
        'productType',
        'photo',
        'statusLogic'
    ];

    // Relación recibiendo de otros modelos
    public function baseProduct()
    {
        return $this->belongsTo(BaseProduct::class, 'idBaseProduct', 'idBaseProduct');
    }

    //Relacion enviando a otros modelos
    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'idProduct', 'idProduct');
    }

    public function inventoryData()
    {
        return $this->hasMany(InventoryData::class, 'idProduct', 'idProduct');
    }

    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class, 'idProduct', 'idProduct');
    }
}
