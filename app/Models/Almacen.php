<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'id_explotacion'];
    protected $hidden = ['created_at', 'updated_at'];


    public function explotacion(){
        return $this->belongsTo(Explotacion::class);
    }
    public function quimicos()
    {
        return $this->belongsToMany(Quimico::class, 'almacen_quimico', 'id_almacen', 'id_quimico')
            ->withPivot('cantidad') // Para acceder a la cantidad en la tabla intermedia
            ->withTimestamps();
    }

    public function pedidos(){
        return $this->belongsToMany(Pedido::class);
    }
}
