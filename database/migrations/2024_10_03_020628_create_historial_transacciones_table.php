<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_transacciones', function (Blueprint $table) {
            $table->bigIncrements('codigo_historial_transacciones');
            $table->unsignedBigInteger('id'); 
            $table->foreign('id')->references('id')->on('cuentas');
            $table->unsignedBigInteger('codigo_tipo'); 
            $table->foreign('codigo_tipo')->references('codigo_tipo')->on('tipos');
            $table->decimal('monto', 8, 2);
            $table->timestamps(); #usare esto para FECHA
        });

        DB::table('historial_transacciones')->insert([
            [
                'id' => '1',
                'codigo_tipo' => '1',
                'monto' => '5000',
                'created_at' => '2024-09-10 10:00:00', #FECHA INGRESADA MANUALMENTE PARA MIGRACIÓN
            ],
            [
                'id' => '2',
                'codigo_tipo' => '1',
                'monto' => '200',
                'created_at' => '2024-09-10 11:00:00', #FECHA INGRESADA MANUALMENTE PARA MIGRACIÓN
            ],
          
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_transacciones');
    }
}
