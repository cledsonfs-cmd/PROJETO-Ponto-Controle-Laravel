<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucaos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('idempresa');
            $table->string('codpedido');
            $table->string('produto');
            $table->double('valor',10,2);
            $table->float('quantidade', 10, 3);
            $table->string('unidade');
            $table->date('data_faturada');
            $table->date('data_devolucao');
            $table->string('tipo');
            $table->string('motivo');
            $table->string('representante');
            $table->string('cliente');
            $table->string('origem_erro');
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
        Schema::dropIfExists('devolucaos');
    }
}
