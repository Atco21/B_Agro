<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencia'; // Nombre de la tabla en la BD

    protected $fillable = [
        'fecha',
        'estado',
        'tipo',
        'orden_id'
    ];

    public function Orden(){
        return $this->belongsTo(Orden::class);
    }
}

