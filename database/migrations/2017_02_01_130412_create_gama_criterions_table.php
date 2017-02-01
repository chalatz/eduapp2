<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamaCriterionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gama_criterions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('main_title');

            $table->text('gk1_title');
            $table->text('gk2_title');
            $table->text('gk3_title');
            $table->text('gk4_title');
            $table->text('gk5_title');

            $table->text('gk1_1_title');
            $table->text('gk1_2_title');
            $table->text('gk1_3_title');
            $table->text('gk1_4_title');
            $table->text('gk1_5_title');

            $table->text('gk2_1_title');
            $table->text('gk2_2_title');
            $table->text('gk2_3_title');
            $table->text('gk2_4_title');
            $table->text('gk2_5_title');

            $table->text('gk3_1_title');
            $table->text('gk3_2_title');
            $table->text('gk3_3_title');
            $table->text('gk3_4_title');
            $table->text('gk3_5_title');

            $table->text('gk4_1_title');
            $table->text('gk4_2_title');
            $table->text('gk4_3_title');
            $table->text('gk4_4_title');
            $table->text('gk4_5_title');

            $table->text('gk5_1_title');
            $table->text('gk5_2_title');
            $table->text('gk5_3_title');
            $table->text('gk5_4_title');
            $table->text('gk5_5_title');

            $table->integer('weight');
            
            $table->integer('gk1_weight');
            $table->integer('gk2_weight');
            $table->integer('gk3_weight');
            $table->integer('gk4_weight');
            $table->integer('gk5_weight');

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
        Schema::drop('gama_criterions');
    }
}
