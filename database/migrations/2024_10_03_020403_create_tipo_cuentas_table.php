<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_cuentas', function (Blueprint $table) {
            $table->bigIncrements('codigo_tipo_cuenta');
            $table->string('nombre_tipo_cuenta',100);
            $table->timestamps();
        });


        DB::table('tipo_cuentas')->insert([
            [
                'nombre_tipo_cuenta' => 'CuentaEstandar',
                'created_at' => '2024-10-02 19:01:17',
            ],
            [
                'nombre_tipo_cuenta' => 'CuentaPremium',
                'created_at' => '2024-10-02 19:01:17',
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
        Schema::dropIfExists('tipo_cuentas');
    }
}
