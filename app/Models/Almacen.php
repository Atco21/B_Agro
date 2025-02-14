<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'id_explotacion'];
    protected $hidden = ['created_at', 'updated_at'];
}
