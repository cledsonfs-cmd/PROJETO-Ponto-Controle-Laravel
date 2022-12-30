<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pops', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
	        $table->bigInteger('idsetor');
	        $table->string('revisao');
	        $table->date('data');
	        $table->string('responsavel');
	        $table->string('revisor');
	        $table->string('tarefa');
	        $table->string('resultado');
	        $table->string('equipamentos');
	        $table->string('epi');
	        $table->string('epc');
	        $table->string('recomendacao');
	        $table->string('observacao');
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
        Schema::dropIfExists('pops');
    }
}
