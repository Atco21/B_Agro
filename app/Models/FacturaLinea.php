<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaLinea extends Model
{
    use HasFactory;

    protected $table = 'factura_lineas';

    protected $fillable = [
        'factura_id',
        'numero_linea',
        'cultivo_id',
        'explotacion_id',
        'precio_unitario',
        'cantidad',
        'subtotal',
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }

    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }
}
