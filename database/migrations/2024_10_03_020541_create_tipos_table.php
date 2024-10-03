<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->bigIncrements('codigo_tipo');
            $table->string('nombre_tipo',100);
            $table->timestamps();
        });

        DB::table('tipos')->insert([
            [
                'nombre_tipo' => 'depósito',
                'created_at' => '2024-10-02 19:01:17',
            ],
            [
                'nombre_tipo' => 'retiro',
                'created_at' => '2024-10-02 19:01:17',
            ],
            [
                'nombre_tipo' => 'transferencia',
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
        Schema::dropIfExists('tipos');
    }
}
