<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'persons';

    // Especifico la clave primaria
    protected $primaryKey = 'idPerson';

    // Campos asignables en masa
    protected $fillable = [
        'idUser',
        'idPersonalData',
        'idAddres',
    ];

    // Relaciones recibiendo de otros modelos
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'idPersonalData', 'idPersonalData');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'idAddres', 'idAddres');
    }


    // Relación enviando a otro modelo
    public function userHistories()
    {
        return $this->belongsTo(UserHistory::class, 'idPerson', 'idPerson');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class, 'idPerson', 'idPerson');
    }

    public function jobPositions()
    {
        return $this->hasMany(JobPosition::class, 'idPerson', 'idPerson');
    }
}
