<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    protected $primaryKey = 'id';
    protected $fillable = [
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'id_administrador',
        'id_jefecampo',
        'aplicador_id',
        'parcela_id',
    ];
    /**
     * Relaciones con otras tablas
     */
    
    // Relación con el modelo Trabajador (Jefe de Campo)
    public function jefeCampo()
    {
        return $this->belongsTo(Trabajador::class);
    }

    // Relación con el modelo Trabajador (Aplicador)
    public function aplicador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    // Relación con el modelo Parcela
    public function parcela()
    {
        return $this->belongsTo(Parcela::class);
    }
}
