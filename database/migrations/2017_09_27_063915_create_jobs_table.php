<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('location')->nullable();
            $table->enum('sex',['male','female'])->default('male');
            $table->enum('work_status',['fresher','experience'])->default('fresher');
            $table->string('total_experience')->nullable();
            $table->string('annual_salary')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('department')->nullable();
            $table->string('qualification_level')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('filename')->nullable();
            $table->string('keyskills')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
