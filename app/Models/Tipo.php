<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    protected $table='tipos';
    protected $primaryKey='codigo_tipo';
    protected $fillable=[
    'codigo_tipo',
    'nombre_tipo',
    ];
}
