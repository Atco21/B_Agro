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
        'id_administrador',
        'tarea',
        'id_jefecampo',
        'aplicador_id',
        'parcela_id',
        'id_tratamiento',
        'id_maquina',
    ];

    protected $dates = ['fecha_inicio', 'fecha_fin'];

    // Relaciones con otras tablas
    public function jefeCampo()
    {
        return $this->belongsTo(Trabajador::class, 'id_jefecampo');
    }

    public function aplicador()
    {
        return $this->belongsTo(Trabajador::class, 'aplicador_id');
    }

    public function parcela()
    {
        return $this->belongsTo(Parcela::class);
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina');
    }
}
