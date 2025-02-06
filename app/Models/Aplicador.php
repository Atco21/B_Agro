<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aplicador extends Model
{
    protected $table = 'aplicador';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'id_explotacion', 'DNI', 'nombre'];
    protected $hidden = ['created_at', 'updated_at'];
}
