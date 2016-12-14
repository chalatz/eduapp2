<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');

            $table->char('index', 2);

            $table->boolean('site_submissions')->default(true);
            $table->boolean('phase_a_gradings')->default(false);
            $table->boolean('phase_b_gradings')->default(false);
            $table->boolean('phase_c_gradings')->default(false);

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
        Schema::drop('config');
    }
}
