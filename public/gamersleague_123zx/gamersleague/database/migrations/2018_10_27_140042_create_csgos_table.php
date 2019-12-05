<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csgos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('image')->nullable();
            $table->text('details')->nullable();
            $table->text('team_link')->nullable();
            $table->text('leader')->nullable();
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
        Schema::dropIfExists('csgos');
    }
}
