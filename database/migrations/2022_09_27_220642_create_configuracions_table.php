<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title',67);
            $table->string('seo_description',155);
            $table->string('seo_urlfoto',100);
            $table->string('colorPrimario',7);
            $table->string('colorSecundario',7);
            $table->string('urlfavicon',100);
            $table->string('urllogo',100);
            $table->string('slogan',150);
            $table->string('frase_1',100);
            $table->string('frase_2',100);
            $table->string('frase_3',100);
            $table->string('razonSocial',100);
            $table->string('direccion',150);
            $table->string('celular',11);
            $table->string('mail',100);
            $table->string('facebook',100);
            $table->string('youtube',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracions');
    }
}
