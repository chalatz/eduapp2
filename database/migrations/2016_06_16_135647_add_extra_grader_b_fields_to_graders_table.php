<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraGraderBFieldsToGradersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('graders', function (Blueprint $table) {

            $table->boolean('propose_myself')->default(0);
            $table->text('why_propose_myself')->nullable();
            $table->string('personal_url', 200)->nullable();
            $table->text('comments')->nullable();

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

            $table->dropColumn('propose_myself');
            $table->dropColumn('why_propose_myself');
            $table->dropColumn('personal_url');
            $table->dropColumn('comments');

        });
    }
}
