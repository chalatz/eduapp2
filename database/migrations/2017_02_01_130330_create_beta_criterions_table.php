<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetaCriterionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beta_criterions', function (Blueprint $table) {
            $table->increments('id');

            $table->text('main_title');

            $table->text('bk1_title');
            $table->text('bk2_title');
            $table->text('bk3_title');

            $table->text('bk1_1_title');
            $table->text('bk1_2_title');
            $table->text('bk1_3_title');
            $table->text('bk1_4_title');
            $table->text('bk1_5_title');

            $table->text('bk2_1_title');
            $table->text('bk2_2_title');
            $table->text('bk2_3_title');
            $table->text('bk2_4_title');
            $table->text('bk2_5_title');

            $table->text('bk3_1_title');
            $table->text('bk3_2_title');
            $table->text('bk3_3_title');
            $table->text('bk3_4_title');
            $table->text('bk3_5_title');
            
            $table->integer('weight');
            
            $table->integer('bk1_weight');
            $table->integer('bk2_weight');
            $table->integer('bk3_weight');

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
        Schema::drop('beta_criterions');
    }
}
