<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quimico extends Model
{
    protected $table = 'quimicos';
    protected $primary = 'id';
    protected $fillable = ['nombre', 'tipo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function almacen(){
        return $this->hasMany(Almacen::class, 'id');
    }
}
