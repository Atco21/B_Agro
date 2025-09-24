<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Almacen;

class Explotacion extends Model
{
    protected $table = 'explotaciones';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'direccion', 'localidad', 'tamanyo'];
    protected $hidden = ['created_at', 'updated_at'];


    public function almacenes()
    {
        return $this->hasMany(Almacen::class);
    }
    public function parcelas()
    {
    return $this->hasMany(Parcela::class);
    }
}



