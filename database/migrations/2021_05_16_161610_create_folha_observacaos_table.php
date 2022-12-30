<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolhaObservacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folha_observacaos', function (Blueprint $table) {
            $table->id();
            $table->string('folha');
            $table->bigInteger('idprocesso');
	        $table->string('nome_peca');
	        $table->bigInteger('idmaquina');
	        $table->bigInteger('idoperador');
	        $table->string('experiencia_servico');
	        $table->bigInteger('idmestre');
	        $table->date('data');
            $table->string('operacao');
	        $table->Integer('numero_operacao');
	        $table->Integer('numero_peca');
	        $table->Integer('numero_maquina');
	        $table->string('sexo');
	        $table->bigInteger('idmateraprima');
	        $table->string('numero_secao');
	        $table->dateTime('inicio');
	        $table->dateTime('fim');
	        $table->Integer('numero_maquinas');
	        $table->Integer('unidades_acabadas');
	        $table->float('fadiga',10,3);
	        $table->float('setup',10,3);
	        $table->float('jornada',10,3);
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
        Schema::dropIfExists('folha_observacaos');
    }
}
