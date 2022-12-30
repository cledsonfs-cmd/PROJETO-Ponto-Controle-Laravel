<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReprogramacaoRetrabalhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reprogramacao_retrabalhos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('idempresa');
            $table->date('data');            
            $table->bigInteger('idsetor');
            $table->bigInteger('idproduto');
            $table->Integer('retrabalho');
            $table->float('quantidade',10,3);
            $table->float('custo',10,3);
            $table->bigInteger('idmotivo');
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
        Schema::dropIfExists('reprogramacao_retrabalhos');
    }
}
