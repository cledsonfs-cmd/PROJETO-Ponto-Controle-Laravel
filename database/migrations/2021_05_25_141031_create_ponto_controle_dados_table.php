<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontoControleDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponto_controle_dados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idponto_controle');	        
            $table->dateTime('data_hora');
            $table->string('produto_componente');
            $table->float('quantidade',10,3);
            $table->float('peso',10,3);
            $table->float('volume',10,3);
            $table->float('valor',10,3);	
	        $table->string('observacao');
	        $table->string('extra1');
	        $table->string('extra2');
	        $table->string('extra3');
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
        Schema::dropIfExists('ponto_controle_dados');
    }
}
