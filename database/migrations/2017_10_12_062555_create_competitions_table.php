<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->integer('category_id');
            $table->string('filename')->nullable();
            $table->integer('minimum_candidates');
            $table->integer('minimum_points');
            $table->enum('status',['0','1'])->default('0');
            $table->enum('isstart',['0','1'])->default('0');
            $table->enum('isend',['0','1'])->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('competitions');
    }
}
