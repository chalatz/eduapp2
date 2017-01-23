<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_graders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('grader_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('sites_left')->unsigned();

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
        Schema::drop('the_graders');
    }
}
