<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explotacion extends Model
{
    protected $table = 'explotaciones';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'direccion', 'localidad', 'tamanyo']; 
    protected $hidden = ['created_at', 'updated_at'];
}
