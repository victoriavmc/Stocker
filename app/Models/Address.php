<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'addresses';

    // Especifico la clave primaria
    protected $primaryKey = 'idAddres';

    // Campos asignables en masa
    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'house',
        'streetBlock',
        'sector',
    ];

    // Relación con el modelo Person
    public function person()
    {
        return $this->hasOne(Person::class, 'idAddres', 'idAddres');
    }
}
