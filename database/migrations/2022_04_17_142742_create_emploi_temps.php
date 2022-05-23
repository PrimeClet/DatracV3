<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploiTemps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->date('debut_fonction');
            $table->date('fin_fonction');
            $table->date('jour');
            $table->date('heure_debut');
            $table->date('heure_fin');
            $table->enum('est_Present', ['P', 'A'])->default('P');
            $table->unsignedBigInteger('etablissement_id')->unsigned();
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('agent_etablissement_id')->unsigned();
            $table->foreign('agent_etablissement_id')
                ->references('id')
                ->on('agent_etablissements')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('emploi_temps');
    }
}
