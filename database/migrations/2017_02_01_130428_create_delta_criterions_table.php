<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeltaCriterionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delta_criterions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('main_title');

            $table->text('dk1_title');
            $table->text('dk2_title');
            $table->text('dk3_title');
            $table->text('dk4_title');
            $table->text('dk5_title');

            $table->text('dk1_1_title');
            $table->text('dk1_2_title');
            $table->text('dk1_3_title');
            $table->text('dk1_4_title');
            $table->text('dk1_5_title');

            $table->text('dk2_1_title');
            $table->text('dk2_2_title');
            $table->text('dk2_3_title');
            $table->text('dk2_4_title');
            $table->text('dk2_5_title');

            $table->text('dk3_1_title');
            $table->text('dk3_2_title');
            $table->text('dk3_3_title');
            $table->text('dk3_4_title');
            $table->text('dk3_5_title');

            $table->text('dk4_1_title');
            $table->text('dk4_2_title');
            $table->text('dk4_3_title');
            $table->text('dk4_4_title');
            $table->text('dk4_5_title');

            $table->text('dk5_1_title');
            $table->text('dk5_2_title');
            $table->text('dk5_3_title');
            $table->text('dk5_4_title');
            $table->text('dk5_5_title');
            
            $table->integer('weight');
            
            $table->integer('dk1_weight');
            $table->integer('dk2_weight');
            $table->integer('dk3_weight');
            $table->integer('dk4_weight');
            $table->integer('dk5_weight');            

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
        Schema::drop('delta_criterions');
    }
}
