<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulars', function (Blueprint $table) {
            $table->bigIncrements('codigo_titular_cuenta');
            $table->string('nombre',100);
            $table->string('direccion',100);
            $table->timestamps();
        });

        DB::table('titulars')->insert([
            [
                'nombre' => 'John Doe',
                'direccion' => '123 Main St',
                'created_at' => '2024-10-02 19:01:17',
            ],
            [
                'nombre' => 'Jane Smith',
                'direccion' => '456 Elm St',
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
        Schema::dropIfExists('titulars');
    }
}
