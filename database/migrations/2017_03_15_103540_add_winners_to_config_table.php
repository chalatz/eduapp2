<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWinnersToConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            
            $table->text('winners_a')->nullable()->after('phase_c_gradings');
            $table->text('winners_b')->nullable()->after('winners_a');
            $table->text('winners_c')->nullable()->after('winners_b');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            
            $table->dropColumn('winners_a');
            $table->dropColumn('winners_b');
            $table->dropColumn('winners_c');

        });
    }
}
