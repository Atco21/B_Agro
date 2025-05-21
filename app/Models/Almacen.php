<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function cosecha(){
        return $this->hasMany(Cosecha::class, 'almacen_id');
    }

    public function quimicos()
    {
        return $this->hasMany(Quimico::class, 'almacen_id');
    }
}

