<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            
            $table->integer('specialty_id')->default(0);
            $table->integer('primary_edu_id')->default(0);
            $table->integer('secondary_edu_id')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            
            $table->dropColumn('specialty_id');
            $table->dropColumn('primary_edu_id');
            $table->dropColumn('secondary_edu_id');

        });
    }
}
