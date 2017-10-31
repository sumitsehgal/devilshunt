<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('dob')->nullable();//age
            $table->enum('sex', ['male', 'female'])->default('male');
            $table->enum('maritial_status', ['single', 'married', 'divorcee'])->default('single');
            $table->string('language')->nullable();
            $table->enum('hair', ['long', 'short', 'average'])->default('average');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('professional_experience')->nullable();
            $table->string('qualification')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('filename')->nullable();
            $table->string('passport')->nullable();
            $table->enum('visa_rejected', ['yes', 'no'])->default('no');
            $table->date('doexpiry')->nullable();
            $table->date('issue_date')->nullable();
            $table->enum('outdoor_shoot', ['yes', 'no'])->default('no');
            $table->enum('night_shoot', ['yes', 'no'])->default('no');
            $table->string('family_info')->nullable();
            $table->string('category')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('correspondence_address')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('aadharcard_no')->nullable();
            $table->string('drivinglicense_no')->nullable();
            $table->string('portfolio_address')->nullable();
            $table->string('project')->nullable();
            $table->string('special_portfolio_address')->nullable();
            $table->string('special_project')->nullable();
            $table->text('about_you')->nullable();

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
        Schema::dropIfExists('auditions');
    }
}
