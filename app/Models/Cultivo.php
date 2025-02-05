<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    protected $table = 'cultivos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre'];
    protected $hidden = ['created_at', 'updated_at'];
}
