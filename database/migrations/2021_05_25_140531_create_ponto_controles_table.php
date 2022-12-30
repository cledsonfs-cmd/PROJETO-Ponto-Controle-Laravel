<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontoControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponto_controles', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->bigInteger('idsetor');	        
            $table->Integer('produto_componente');
            $table->Integer('quantidade');
            $table->Integer('peso');
            $table->Integer('volume');
            $table->Integer('valor');	
	        $table->Integer('observacao');
	        $table->Integer('extra1');
	        $table->Integer('extra2');
	        $table->Integer('extra3');
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
        Schema::dropIfExists('ponto_controles');
    }
}
