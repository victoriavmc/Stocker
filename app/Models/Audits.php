<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'audits';

    // Especifico la clave primaria
    protected $primaryKey = 'idAudit';

    // Campos asignables en masa
    protected $fillable = [
        'tableName',
        'recordId',
        'action',
        'oldValue',
        'newValue',
        'idPerson',
    ];

    // Relaciones recibiendo de otros modelos
    public function person()
    {
        return $this->belongsTo(Person::class, 'idPerson', 'idPerson');
    }
}
