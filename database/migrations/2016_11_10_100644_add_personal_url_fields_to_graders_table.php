<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalUrlFieldsToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {
            
            $table->string('personal_url_2', 200)->nullable()->after('personal_url');
            $table->string('personal_url_3', 200)->nullable()->after('personal_url_2');
            $table->string('personal_url_4', 200)->nullable()->after('personal_url_3');

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
            
            $table->dropColumn('personal_url_2');
            $table->dropColumn('personal_url_3');
            $table->dropColumn('personal_url_4');

        });
    }
}
