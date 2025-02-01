<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'pricehistory';

    // Especifico la clave primaria
    protected $primaryKey = 'idPriceHistory';

    // Campos asignables en masa
    protected $fillable = [
        'unitPrice',
        'startSeason',
        'endSeason',
        'idProduct'
    ];

    // Relación recibiendo de otros modelos
    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'idProduct');
    }
}
