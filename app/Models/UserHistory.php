<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'userhistories';

    // Especifico la clave primaria
    protected $primaryKey = 'idUserHistory';

    // Campos asignables en masa
    protected $fillable = [
        'statusLogic', // Activo, Inactivo, Suspendido
        'idPerson',
    ];

    // Relación con el modelo Person
    public function person()
    {
        return $this->belongsTo(Person::class, 'idPerson', 'idPerson');
    }
}
