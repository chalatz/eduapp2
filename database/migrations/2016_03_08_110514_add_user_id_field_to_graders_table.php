<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdFieldToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('id');
            $table->string('last_name');
            $table->string('first_name');
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
            $table->dropColumn('user_id');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
        });
    }
}
