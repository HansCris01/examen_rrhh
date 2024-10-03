<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_transaccione extends Model
{
    use HasFactory;
    protected $table='historial_transacciones';
    protected $primaryKey='codigo_historial_transacciones';
    protected $fillable=[
    'codigo_historial_transacciones',    
    'id',
    'codigo_tipo',
    'monto',
    ];


}
