<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('codigo_titular_cuenta'); 
            $table->foreign('codigo_titular_cuenta')->references('codigo_titular_cuenta')->on('titulars');
            $table->decimal('saldo', 8, 2);
            $table->unsignedBigInteger('codigo_tipo_cuenta'); 
            $table->foreign('codigo_tipo_cuenta')->references('codigo_tipo_cuenta')->on('tipo_cuentas');
            $table->timestamps();
        });

        DB::table('cuentas')->insert([
            [
                'codigo_titular_cuenta' => '1',
                'saldo' => '5000',
                'codigo_tipo_cuenta' => '1',
                'created_at' => '2024-10-02 19:01:17',
            ],
            [
                'codigo_titular_cuenta' => '2',
                'saldo' => '200',
                'codigo_tipo_cuenta' => '1',
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
        Schema::dropIfExists('cuentas');
    }
}
