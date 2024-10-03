<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;
    protected $table='cuentas';
    protected $primaryKey='id';
    protected $fillable=[
    'id',    
    'codigo_titular_cuenta',
    'saldo',
    'codigo_tipo_cuenta',
    ];
}
