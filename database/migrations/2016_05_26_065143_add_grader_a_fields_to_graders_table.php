<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGraderAFieldsToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {
            $table->integer('specialty_id');
            $table->integer('district_id');
            $table->text('address')->nullable();
            $table->string('desired_category', 30)->nullable();
            $table->string('past_grader', 10)->nullable();
            $table->string('past_grader_more', 10)->nullable();
            $table->string('wants_to_be_grader_b', 10)->nullable();
            $table->integer('english')->unsigned()->nullable();
            $table->integer('french')->unsigned()->nullable();
            $table->integer('german')->unsigned()->nullable();
            $table->integer('italian')->unsigned()->nullable();
            $table->string('english_level', 100)->nullable();
            $table->string('french_level', 100)->nullable();
            $table->string('german_level', 100)->nullable();
            $table->string('italian_level', 100)->nullable();
            $table->string('languages_other', 200)->nullable();
            $table->string('languages_other_level', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('graders', function (Blueprint $table) {
            $table->dropColumn('specialty_id');
            $table->dropColumn('district_id');
            $table->dropColumn('address');
            $table->dropColumn('desired_category');
            $table->dropColumn('past_grader');
            $table->dropColumn('past_grader_more');
            $table->dropColumn('wants_to_be_grader_b');
            $table->dropColumn('english');
            $table->dropColumn('french');
            $table->dropColumn('german');
            $table->dropColumn('italian');
            $table->dropColumn('english_level');
            $table->dropColumn('french_level');
            $table->dropColumn('german_level');
            $table->dropColumn('italian_level');
            $table->dropColumn('languages_other');
            $table->dropColumn('languages_other_level');
        });
    }
}
