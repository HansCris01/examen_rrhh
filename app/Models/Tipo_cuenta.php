<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_cuenta extends Model
{
    use HasFactory;
    protected $table='tipo_cuentas';
    protected $primaryKey='codigo_tipo_cuenta';
    protected $fillable=[
    'codigo_tipo_cuenta',
    'nombre_tipo_cuenta',
    ];
}
