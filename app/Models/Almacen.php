<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'explotacion_id'];
    protected $hidden = ['created_at', 'updated_at'];
    public function explotacion()
    {
        return $this->belongsTo(Explotacion::class, 'explotacion_id');
    }
}

