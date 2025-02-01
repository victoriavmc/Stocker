<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'personaldata';

    // Especifico la clave primaria
    protected $primaryKey = 'idPersonalData';

    // Campos asignables en masa
    protected $fillable = [
      'firstName',
      'lastName',
      'cuit',
      'birthdate',
      'gender',
      'nationality',
    ];

    // Relación con el modelo Person
    public function person()
    {
        return $this->hasOne(Person::class, 'idPersonalData', 'idPersonalData');
    }
}
