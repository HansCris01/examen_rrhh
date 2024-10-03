<?php

namespace App\Http\Controllers;

#Este codigo es para llamar los objetos para aplicar la herencia a estre controlador que básicamente es una clase
use App\Models\Cuenta;
use App\Models\Historial_transaccione;
#use App\Models\Tipo;
#use App\Models\Tipo_cuenta;
#use App\Models\Titular;

use Illuminate\Http\Request;

class CuentaController extends Controller
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
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function listar_cuentas()
    {
        $datos['cuentas'] = Cuenta::select("cuentas.id", "cuentas.saldo", "titulars.nombre")
        ->join('titulars','titulars.codigo_titular_cuenta','cuentas.codigo_titular_cuenta')
        ->get();

        return $datos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_envia) #Transferencia
    {
        //
        $Cuenta = Cuenta::where("id","=", $id_envia)->select("cuentas.saldo", "tipo_cuentas.codigo_tipo_cuenta" ,"tipo_cuentas.nombre_tipo_cuenta")
      ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
      ->first();
      $saldo = $Cuenta->saldo;
      $codigo_tipo_cuenta = $Cuenta->codigo_tipo_cuenta;
      $monto = $request->monto;
      $id_recibe = $request->id_recibe;

      if($codigo_tipo_cuenta == 1){ #cuenta standar
        
        
      if($monto > $saldo ){

        return response()->json(['Saldo insuficiente']);

      } elseif($monto < $saldo || $monto == $saldo) {

            #El que envia la transferencia

            $calculo = $saldo - $monto;
            $datos = [ 
            "saldo" => $calculo,
            ];

            Cuenta::where('id','=',$id_envia)->update($datos);

            //agregar al historial de movimientos de transacciones

            $historial_transaccione = new Historial_transaccione();

            $historial_transaccione->id = $id_envia; #ID el que envia la tranferencia
            $historial_transaccione->codigo_tipo = 3; #tansferencia
            $historial_transaccione->monto = $monto;
            #la fecha es tomada del sistema que es created_at
            $historial_transaccione->save();

            #El que recibe la trasnferencia
           
            $cuenta_recibe = Cuenta::where("id","=", $id_recibe)->select("cuentas.saldo", "tipo_cuentas.codigo_tipo_cuenta" ,"tipo_cuentas.nombre_tipo_cuenta")
            ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
            ->first();

            $saldo_recibe = $cuenta_recibe->saldo;
            $calculo_recibe = $saldo_recibe + $monto;

            $datos = [ 
            "saldo" => $calculo_recibe,
            ];

            Cuenta::where('id','=',$id_recibe)->update($datos);

      } 

      
       }elseif($codigo_tipo_cuenta == 2){ #cuenta Premium

       
       if($monto > $saldo ){

        return response()->json(['Saldo insuficiente']);

       } elseif($monto < $saldo || $monto == $saldo) {
        #El que envia la transferencia
               
        $comision = 1; #comision 1%

        $calculo = ($comision / 100) * $monto; 
        $calculo2 = $monto + $calculo;
        $calculo3 = $saldo - $calculo2;
        $datos = [ 
        "saldo" => $calculo3,
        ];
       
       Cuenta::where('id','=',$id_envia)->update($datos);
       

        //agregar al historial de movimientos de transacciones

        $historial_transaccione = new Historial_transaccione();

        $historial_transaccione->id = $id_envia; #ID el que envia la tranferencia
        $historial_transaccione->codigo_tipo = 3; #tansferencia
        $historial_transaccione->monto = $monto;
        #la fecha es tomada del sistema que es created_at
        $historial_transaccione->save();


        #El que recibe la trasnferencia
           
        $cuenta_recibe = Cuenta::where("id","=", $id_recibe)->select("cuentas.saldo", "tipo_cuentas.codigo_tipo_cuenta" ,"tipo_cuentas.nombre_tipo_cuenta")
        ->join('tipo_cuentas','tipo_cuentas.codigo_tipo_cuenta','cuentas.codigo_tipo_cuenta')
        ->first();

        $saldo_recibe = $cuenta_recibe->saldo;
        $calculo_recibe = $saldo_recibe + $monto;

        $datos = [ 
        "saldo" => $calculo_recibe,
        ];

        Cuenta::where('id','=',$id_recibe)->update($datos);

       }

     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuenta $cuenta)
    {
        //
    }
}
