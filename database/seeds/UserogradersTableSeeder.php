<?php

use Illuminate\Database\Seeder;

class UserogradersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('graders')->truncate();
        DB::table('suggestions')->truncate();
        DB::table('role_user')->truncate();

        factory(App\User::class, 50)->create()->each(function($u) {

            $u->grader()->save(factory(App\Grader::class)->make());

            $suggestion = factory(App\Suggestion::class)->create([
                'user_id' => $u->id,
                'suggestor_name' => 'john doe',
                'grader_email' => $u->email,
                'suggestor_email' => $u->email,
                'accepted' => 'yes',
                'self_proposed' => 'yes',
                'personal_msg' => 'Self proposed',
                'unique_string' => 'Self proposed',
            ]);

            $i = 0;

            if($i < 20){
                DB::table('role_user')->insert([
                    'user_id' => $u->id,
                    'role_id' => 2,
                ]);
            }

            $i++;

        });

    }
}
