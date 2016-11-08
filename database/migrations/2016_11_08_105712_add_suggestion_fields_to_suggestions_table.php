<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuggestionFieldsToSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            
            $table->string('suggestor_url')->after('suggestor_email');
            $table->string('suggestor_phone')->after('suggestor_url')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            
            $table->dropColumn('suggestor_url');
            $table->dropColumn('suggestor_phone');            

        });
    }
}
