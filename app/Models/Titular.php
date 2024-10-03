<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titular extends Model
{
    use HasFactory;
    protected $table='titulars';
    protected $primaryKey='codigo_titular_cuenta';
    protected $fillable=[
    'codigo_titular_cuenta',
    'nombre',
    'direccion',
    ];
}
