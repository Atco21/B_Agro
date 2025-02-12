<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendimiento extends Model
{
    use HasFactory;

    protected $table = 'rendimientos';

    protected $fillable = [
        'parcela_id',
        'c_sembrada',
        'c_recolectada',
        'c_esperada',
        'semillaCostes',
        'fertilizantesCostes',
        'otrosCostes',
        'precio_tonelada',
        'total_vendido',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function parcela()
    {
        return $this->belongsTo(Parcela::class);
    }

    protected $dates = [
        'fecha_inicio',
        'fecha_fin',
    ];
}
