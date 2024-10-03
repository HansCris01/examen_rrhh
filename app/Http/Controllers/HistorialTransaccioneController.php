<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Historial_transaccione;
use App\Models\Tipo;
use App\Models\Tipo_cuenta;
use App\Models\Titular;
use Illuminate\Http\Request;

class HistorialTransaccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historial_transaccione  $historial_transaccione
     * @return \Illuminate\Http\Response
     */
    public function ver_detalle_cuenta($id)
    {
        
        $datos['cuentas'] = Cuenta::where("cuentas.id","=",$id)->select("cuentas.id", "cuentas.saldo", "titulars.nombre", "titulars.direccion",
        "tipo_cuentas.nombre_tipo_cuenta", "tipos.nombre_tipo", "historial_transacciones.monto as monto_transaccion" ,"historial_transacciones.created_at as fecha")
        ->join('titulars','titulars.codigo_titular_cuenta','cuentas.codigo_titular_cuenta')
        ->join('historial_transacciones','historial_transacciones.id','cuentas.id')
        ->join('tipos','tipos.codigo_tipo','historial_transacciones.codigo_tipo')
        ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
        ->get();

        return $datos;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historial_transaccione  $historial_transaccione
     * @return \Illuminate\Http\Response
     */
    public function edit(Historial_transaccione $historial_transaccione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historial_transaccione  $historial_transaccione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigo_historial_transacciones) #Retiro
    {
    
      #comision del 2% del retiro
   
       $monto = $request->monto;
       $comision = 0.02;

       $calculo = ($comision / 100) * $monto; 

       $datos = [ 
         "monto" => $calculo,
       ];
       
       Historial_transaccione::where('codigo_historial_transacciones','=',$codigo_historial_transacciones)->update($datos);
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historial_transaccione  $historial_transaccione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historial_transaccione $historial_transaccione)
    {
        //
    }
}
