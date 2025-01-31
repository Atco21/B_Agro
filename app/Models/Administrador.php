<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
 
    protected $table = 'administradores';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'usuario', 'contrasenya', 'telefono', 'direccion', 'ciudad', 'codigo_postal', 'email', 'rol'];

}
