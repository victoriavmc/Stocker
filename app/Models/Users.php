<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //Definir el nombre de la tabla
    protected $table = 'users';

    // Especifico la clave primaria
    protected $primaryKey = 'idUser';

    //Campos asignable en masa
    protected $fillable = [
        'username',
        'password',
        'email',
        'pin',
        'photo'
    ];

    // Relación con el modelo Person
    public function person()
    {
        return $this->hasOne(Person::class, 'idUser', 'idUser');
    }
}
