<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCiudadToVacanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //No me la ha dejado hacer foreign porque ya tengo datos metidos en la bbdd, sería una foreign pero no esta así
        Schema::table('vacantes', function (Blueprint $table) {
            //$table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('cascade');
            $table->foreignId('ciudad_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacantes', function (Blueprint $table) {
            //$table->dropForeign('vacantes_ciudad_id_foreign');
            $table->dropColumn('ciudad_id');
        });
    }
}
