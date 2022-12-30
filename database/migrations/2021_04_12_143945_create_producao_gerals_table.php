<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducaoGeralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producao_gerals', function (Blueprint $table) {
            $table->increments('id');            
            $table->date('data');
            $table->string('componente');
            $table->float('quantidade', 10, 3);
            $table->float('peso', 10, 3);
            $table->bigInteger('idsetor');
            $table->bigInteger('idmaquina');
            $table->bigInteger('idprocesso');
            $table->Integer('controlado');
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
        Schema::dropIfExists('producao_gerals');
    }
}
