<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseProducts extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'baseproducts';

    // Especifico la clave primaria
    protected $primaryKey = 'idBaseProduct';

    // Campos asignables en masa
    protected $fillable = [
        'brand',
        'name',
    ];

    // Relación enviando de otros modelos
    public function products()
    {
        return $this->hasMany(Products::class, 'idBaseProduct', 'idBaseProduct');
    }


}
