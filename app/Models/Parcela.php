<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $table = 'parcelas';

    protected $primaryKey = 'id';

    protected $fillable = ['explotacion_id', 'cultivo_n', 'nombre', 'area',
    ];

    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class);
    }

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }



}
