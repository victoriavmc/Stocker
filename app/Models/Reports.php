<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'reports';

    // Especifico la clave primaria
    protected $primaryKey = 'idReport';

    // Campos asignables en masa
    protected $fillable = [
        'observation',
        'statusLogic',
        'idArchivist',
    ];

    // Relación recibiendo de otros modelos
    public function archivist()
    {
        return $this->belongsTo(Archivist::class, 'idArchivist', 'idArchivist');
    }
}
