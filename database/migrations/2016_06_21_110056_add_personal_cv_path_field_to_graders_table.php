<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalCvPathFieldToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {

            $table->string('personal_cv_path')->nullable();

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

            $table->dropColumn('personal_cv_path');

        });
    }
}
