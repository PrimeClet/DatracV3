<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVilles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->boolean('seen')->default(false);
            $table->boolean('statut')->default(true);
            $table->timestamps();
        });

        DB::connection('mysql')->table('villes')
            ->insert(
                array(
                    array('libelle'=>'Libreville','province_id'=>1),
                    array('libelle'=>'Franceville','province_id'=>2),
                    array('libelle'=>'Lambaréné','province_id'=>3),
                    array('libelle'=>'Mouila','province_id'=>4),
                    array('libelle'=>'Tchibanga','province_id'=>5),
                    array('libelle'=>'Makokou','province_id'=>6),
                    array('libelle'=>'Koulamoutou','province_id'=>7),
                    array('libelle'=>'Port-Gentil','province_id'=>8),
                    array('libelle'=>'Oyem','province_id'=>9),
                    array('libelle'=>'Bitam','province_id'=>9),

                )
            );

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villes');
    }
}
