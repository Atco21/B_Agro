<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'cliente_id',
        'fecha',
        'tipo_pago',
        'estado',
        'neto',
        'impuestos',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function lineas()
    {
        return $this->hasMany(FacturaLinea::class);
    }
}
