<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos'; // Nombre de la tabla en la base de datos

    
    protected $fillable = [
        'producto_quimico',  
        'dosis',             
        'nombre_tratamiento', 
        'tempmax',            
        'tempmin',            
        'id_jefeCampo',       
    ];

    /**
     * Relación con la tabla trabajadores (Jefe de Campo)
     */
    public function jefeCampo()
    {
        return $this->belongsTo(Trabajador::class, 'id_jefeCampo');
        // Relaciona el tratamiento con el trabajador que es jefe de campo
    }
}
