<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'tarea',
        'jefecampo_id',
        'aplicador_id1',
        'aplicador_id2',
        'aplicador_id3',
        'aplicador_id4',
        'aplicador_id5',
        'parcela_id',
        'id_tratamiento',
        'id_maquina',
        'explotacion_id'
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin'];

    // Relaciones con otras tablas
    public function jefeCampo() //relaciona Orden con jefecampo (Una orden tiene un trabajador)
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function aplicadores() //relaciona Orden Aplicador
    {
        return $this->belongsTo(User::class, 'aplicador_id1');
    }



    public function parcela() //relaciona Oreden con parcela
    {
        return $this->belongsTo(Parcela::class);
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }

    public function maquina()
    {
        return $this->belongsTo(Maquina::class);
    }
}
