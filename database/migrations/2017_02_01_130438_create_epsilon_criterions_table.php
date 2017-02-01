<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpsilonCriterionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epsilon_criterions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('main_title');

            $table->text('ek1_title');
            $table->text('ek1_explain');
            $table->text('ek2_title');
            $table->text('ek2_explain');
            $table->text('ek3_title');

            $table->text('ek1_1_title');
            $table->text('ek1_2_title');
            $table->text('ek1_3_title');
            $table->text('ek1_4_title');
            $table->text('ek1_5_title');

            $table->text('ek2_1_title');
            $table->text('ek2_2_title');
            $table->text('ek2_3_title');
            $table->text('ek2_4_title');
            $table->text('ek2_5_title');
                        
            $table->integer('weight');
            
            $table->integer('ek1_weight');
            $table->integer('ek2_weight');
            $table->integer('ek3_weight');

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
        Schema::drop('epsilon_criterions');
    }
}
