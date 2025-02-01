<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivist extends Model
{
    // Definir el nombre de la tabla
    protected $table = 'archivist';

    // Especifico la clave primaria
    protected $primaryKey = 'idArchivist';

    // Campos asignables en masa
    protected $fillable = [
        'date',
        'movementType',
        'invoiceNumber',
        'statusLogic',
        'idInventoryData',
    ];

    // Relación recibiendo de otros modelos
    public function inventoryData()
    {
        return $this->belongsTo(InventoryData::class, 'idInventoryData', 'idInventoryData');
    }

    //Relacion enviando a otros modelos
    public function reports()
    {
        return $this->hasMany(Reports::class, 'idArchivist', 'idArchivist');
    }

}
