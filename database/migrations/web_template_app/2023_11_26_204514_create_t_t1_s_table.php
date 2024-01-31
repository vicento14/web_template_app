<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTT1STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('t_t1_s', function (Blueprint $table) {
            $table->id();
            $table->string('c1', 255)->unique();
            $table->string('c2', 255);
            $table->string('c3', 255);
            $table->string('c4', 255);
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
        Schema::connection('mysql')->dropIfExists('t_t1_s');
    }
}
