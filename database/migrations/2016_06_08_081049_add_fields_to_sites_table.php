<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {

            $table->text('creator');
            $table->text('responsible');
            $table->string('responsible_type', 150);
            $table->integer('district_id')->unsigned();
            $table->integer('county_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->default(1);
            $table->integer('language_id')->unsigned();
            $table->string('uses_private_data', 10)->nullable();
            $table->string('received_permission', 10)->nullable();
            $table->string('restricted_access', 10)->nullable();
            $table->text('restricted_access_details')->nullable();
            $table->text('purpose')->nullable();

            $table->string('contact_last_name', 150);
            $table->string('contact_first_name', 150);
            $table->string('contact_email', 150);
            $table->string('contact_phone', 150);
            $table->string('contact_address', 150);

            $table->boolean('i_agree')->default(0);

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

            $table->dropColumn('creator');
            $table->dropColumn('responsible');
            $table->dropColumn('responsible_type');
            $table->dropColumn('district_id');
            $table->dropColumn('county_id');
            $table->dropColumn('country_id');
            $table->dropColumn('language_id');
            $table->dropColumn('uses_private_data');
            $table->dropColumn('received_permission');
            $table->dropColumn('restricted_access');
            $table->dropColumn('restricted_access_details');
            $table->dropColumn('purpose');

            $table->dropColumn('contact_last_name');
            $table->dropColumn('contact_first_name');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_phone');
            $table->dropColumn('contact_address');

            $table->dropColumn('i_agree');

        });
    }
}
