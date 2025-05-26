<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlmacenQuimico extends Model
{

    protected $table = 'almacen_quimico';

    protected $fillable = [
        'almacen_id',
        'quimico_id',
        'cantidad',
        'unidad',
        'stock_minimo',
        'stock_maximo',
        'stock',
    ];

    // Relaciones

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    public function quimico()
    {
        return $this->belongsTo(Quimico::class, 'quimico_id');
    }


    public static function quimicosEnPeligroPorAlmacen($almacenId)
    {
        return self::with('quimico')
            ->where('almacen_id', $almacenId)
            ->whereColumn('stock', '<', 'stock_minimo')
            ->get();
    }
}
