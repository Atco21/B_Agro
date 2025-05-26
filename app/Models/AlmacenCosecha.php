<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AlmacenCosecha extends Model
{
    protected $table = 'almacen_cosecha';

    protected $fillable = [
        'almacen_id',
        'cultivo_id',
        'unidad_medida',
        'precioPorUnidad',
    ];


        public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
