<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha_pedido', 'cantidad', 'estado'];
    protected $hidden = ['created_at', 'updated_at'];

    public function almacen(){
        return $this->belongsToMany(Almacen::class);
    }
}
