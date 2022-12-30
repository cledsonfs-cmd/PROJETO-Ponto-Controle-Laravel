<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolhaElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folha_elementos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idfolhaobservacao');
	        $table->Integer('ordinal');
	        $table->string('elemento');
	        $table->Integer('velocidade');
	        $table->Integer('avanco');
            $table->double('tempo1',10,2);
            $table->double('tempo2',10,2);
            $table->double('tempo3',10,2);
            $table->double('tempo4',10,2);
            $table->double('tempo5',10,2);
            $table->double('tempo6',10,2);
            $table->double('tempo7',10,2);
            $table->double('tempo8',10,2);
            $table->double('tempo9',10,2);
            $table->double('tempo10',10,2);            
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
        Schema::dropIfExists('folha_elementos');
    }
}
