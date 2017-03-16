<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations_b', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('grader_id')->default(0);
			$table->integer('site_id')->default(0);

            $table->string('can_evaluate', 10)->nullable()->default('na');
            $table->text('why_cannot_evaluate')->nullable();

            $table->string('is_educational', 10)->nullable()->default('na');
            $table->text('why_not_educational')->nullable();

			$table->integer('bk1')->default(0);
            $table->integer('bk2')->default(0);
            $table->integer('bk3')->default(0);
            
			$table->integer('gk1')->default(0);
            $table->integer('gk2')->default(0);
            $table->integer('gk3')->default(0);
            $table->integer('gk4')->default(0);
            $table->integer('gk5')->default(0);

            $table->integer('dk1')->default(0);
            $table->integer('dk2')->default(0);
            $table->integer('dk3')->default(0);
            $table->integer('dk4')->default(0);
            $table->integer('dk5')->default(0);

            $table->integer('ek1')->default(0);
            $table->integer('ek2')->default(0);
            $table->integer('ek3')->default(0);

            $table->integer('stk1')->default(0);
            $table->integer('stk2')->default(0);
            $table->integer('stk3')->default(0);
            $table->integer('stk4')->default(0);

			$table->integer('beta_grade')->default(0);
			$table->integer('gama_grade')->default(0);
			$table->integer('delta_grade')->default(0);
			$table->integer('epsilon_grade')->default(0);
			$table->integer('st_grade')->default(0);

            $table->text('site_comment')->nullable();

            $table->text('bk1_comment')->nullable();
            $table->text('bk2_comment')->nullable();
            $table->text('bk3_comment')->nullable();

            $table->text('gk1_comment')->nullable();
            $table->text('gk2_comment')->nullable();
            $table->text('gk3_comment')->nullable();
            $table->text('gk4_comment')->nullable();
            $table->text('gk5_comment')->nullable();

            $table->text('dk1_comment')->nullable();
            $table->text('dk2_comment')->nullable();
            $table->text('dk3_comment')->nullable();
            $table->text('dk4_comment')->nullable();
            $table->text('dk5_comment')->nullable();

            $table->text('ek1_comment')->nullable();
            $table->text('ek2_comment')->nullable();
            $table->text('ek3_comment')->nullable();

            $table->text('stk1_comment')->nullable();
            $table->text('stk2_comment')->nullable();
            $table->text('stk3_comment')->nullable();
            $table->text('stk4_comment')->nullable();

            $table->text('beta_comment')->nullable();
            $table->text('gama_comment')->nullable();
            $table->text('delta_comment')->nullable();
            $table->text('epsilon_comment')->nullable();
            $table->text('st_comment')->nullable();

			$table->integer('total_grade')->default(0);

            $table->date('assigned_at')->nullable();

            $table->date('assigned_until')->nullable();

            $table->string('finalized', 10)->nullable()->default('na');
            $table->date('finalized_at')->nullable();

            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations_b', function (Blueprint $table) {
            
            Schema::drop('evaluations_b');

        });
    }
}
