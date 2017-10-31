<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('competition_id');
            $table->float('no_of_days')->default('0');
            $table->date('end_date');
            $table->time('end_time');
            $table->integer('minimum_candidate');
            $table->integer('minimum_points');
            $table->integer('sequence_order');
            $table->enum('underwork',['0','1'])->default('0');
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
        Schema::dropIfExists('levels');
    }
}
