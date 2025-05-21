<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cosecha extends Model
{
    protected $table = 'cosecha';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'cultivo_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class, 'cultivo_id');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
}
