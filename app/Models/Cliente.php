<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{


    protected $table = 'clientes';


    protected $fillable = [
        'nombre_completo',
        'dni_nif',
        'direccion',
        'telefono',
        'email',
        'es_empresa',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}
