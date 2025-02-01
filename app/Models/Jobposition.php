<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobposition extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'jobposition';

    // Especifico la clave primaria
    protected $primaryKey = 'idJobPosition';

    // Campos asignables en masa
    protected $fillable = [
        'startDate',
        'endDate',
        'position',
        'status',
        'statusLogic',
        'observation',
        'idPerson',
    ];

    // Relaciones recibiendo de otros modelos
    public function person()
    {
        return $this->belongsTo(Person::class, 'idPerson', 'idPerson');
    }
}
