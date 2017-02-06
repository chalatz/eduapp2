<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_a', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('grader_id');

            $table->integer('sites_count');

            $table->text('grader_name');

            $table->text('grader_email');

            $table->text('site_titles');
            $table->text('site_urls');

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
        Schema::drop('summary_a');
    }
}
