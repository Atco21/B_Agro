<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quimico extends Model
{
    protected $table = 'quimico';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'descripcion', 'tipo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function almacenQuimico()
    {
        return $this->hasMany(AlmacenCosecha::class, 'quimico_id');
    }

}
