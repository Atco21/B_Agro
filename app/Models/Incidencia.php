<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orden;


class Incidencia extends Model
{
    protected $table = 'incidencia';

    protected $fillable = [
        'fecha',
        'descripcion',
        'solucion',
        'estado',
        'tipo',
        'orden_id',
        'user_id',
        'explotacion_id'
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
