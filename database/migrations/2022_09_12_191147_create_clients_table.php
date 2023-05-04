<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->String('numero');
            $table->String('nom');
            $table->String('prenom');
            $table->String('codeclient');
            $table->String('compagnie');
            $table->String('email');
            $table->String('tel');
            $table->String('adresse');
            $table->String('pays')->nullable();
            $table->String('ville');
            $table->String('codep')->nullable();
            $table->String('site')->nullable();
            $table->String('infos')->nullable();
            $table->timestamps();
            $table->String('editorial');
            $table->integer('etat')->default(0);
            $table->integer('deletable')->default(0);

        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
