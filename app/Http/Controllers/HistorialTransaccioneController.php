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
    public function create(Request $request) #Depositar
    {
        //
        $id = $request->id;
        $monto = $request->monto;

        $Historial_transaccione = new Historial_transaccione();
        $Historial_transaccione->id = $id;
        $Historial_transaccione->codigo_tipo = 1;
        $Historial_transaccione->monto = $monto;

        $Historial_transaccione->save();
       
        $Cuenta = Cuenta::where("id","=", $id)->select("cuentas.saldo", "tipo_cuentas.codigo_tipo_cuenta" ,"tipo_cuentas.nombre_tipo_cuenta")
        ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
        ->first();
        $saldo = $Cuenta->saldo;
       

        $calculo = $monto + $saldo;

        $dato = [
        "saldo" => $calculo,

        ];

        Cuenta::where('id','=',$id)->update($dato);

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
    public function update(Request $request, $id) #Retiro
    {
      
      $Cuenta = Cuenta::where("id","=", $id)->select("cuentas.saldo", "tipo_cuentas.codigo_tipo_cuenta" ,"tipo_cuentas.nombre_tipo_cuenta")
      ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
      ->first();
      $saldo = $Cuenta->saldo;
      $codigo_tipo_cuenta = $Cuenta->codigo_tipo_cuenta;
      $saldo_minimo = 100;
      $monto = $request->monto;
     

      if($saldo >= $saldo_minimo && $codigo_tipo_cuenta == 1){ #cuenta standar
        
        
      if($monto > $saldo ){

        return response()->json(['Saldo insuficiente']);

      } elseif($monto < $saldo || $monto == $saldo) {

            #comision del 2% del retiro
                    
            $comision = 2;

            $calculo = ($comision / 100) * $monto; 
            $calculo2 = $monto + $calculo;
            $calculo3 = $saldo - $calculo2;
            $datos = [ 
            "saldo" => $calculo3,
            ];

            Cuenta::where('id','=',$id)->update($datos);

            //agregar al historial de movimientos de transacciones

            $historial_transaccione = new Historial_transaccione();

            $historial_transaccione->id = $id;
            $historial_transaccione->codigo_tipo = 2; #retiro
            $historial_transaccione->monto = $monto;
            #la fecha es tomada del sistema que es created_at
            $historial_transaccione->save();

      } 

      
       }elseif($codigo_tipo_cuenta == 2){ #cuenta Premium

       
       if($monto > $saldo ){

        return response()->json(['Saldo insuficiente']);

       } elseif($monto < $saldo || $monto == $saldo) {
        #comision del 2% del retiro
                    
        $comision = 2;

        $calculo = ($comision / 100) * $monto; 
        $calculo2 = $monto + $calculo;
        $calculo3 = $saldo - $calculo2;
        $datos = [ 
        "saldo" => $calculo3,
        ];
       
       Cuenta::where('id','=',$id)->update($datos);
       

        //agregar al historial de movimientos de transacciones

        $historial_transaccione = new Historial_transaccione();

        $historial_transaccione->id = $id;
        $historial_transaccione->codigo_tipo = 2; #retiro
        $historial_transaccione->monto = $monto;
        #la fecha es tomada del sistema que es created_at
        $historial_transaccione->save();

       }

        }elseif($saldo < $saldo_minimo && $codigo_tipo_cuenta == 1){

          return response()->json(['Operacion rechazada']);

        }
     
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
