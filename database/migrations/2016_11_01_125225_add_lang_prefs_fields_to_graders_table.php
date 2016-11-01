<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangPrefsFieldsToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {
            
            $table->boolean('lang_pref_english')->default(0)->after('languages_other_level');
            $table->boolean('lang_pref_french')->default(0)->after('lang_pref_english');
            $table->boolean('lang_pref_german')->default(0)->after('lang_pref_french');
            $table->boolean('lang_pref_italian')->default(0)->after('lang_pref_german');

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
            
            $table->dropColumn('lang_pref_english');
            $table->dropColumn('lang_pref_french');
            $table->dropColumn('lang_pref_german');
            $table->dropColumn('lang_pref_italian');

        });
    }
}
