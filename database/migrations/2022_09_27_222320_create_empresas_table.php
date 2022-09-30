<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('title',67);
            $table->string('description',155);
            $table->text('somos');
            $table->string('urlsomos',67);
            $table->text('historia');
            $table->string('urlhistoria',67);
            $table->text('mision');
            $table->string('urlmision',67);
            $table->text('vision');
            $table->string('urlvision',67);
            $table->text('valores');
            $table->string('urlvalores',67);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
