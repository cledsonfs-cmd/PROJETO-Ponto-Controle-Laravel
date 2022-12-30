<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrazoEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prazo_entregas', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('idlinhaproducao');
            $table->date('data');
            $table->Integer('registros');
            $table->float('prazo_minimo', 8, 2);
            $table->float('prazo_maximo', 8, 2);
            $table->float('prazo_medio', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prazo_entregas');
    }
}
