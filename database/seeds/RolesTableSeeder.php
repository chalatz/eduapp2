<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'site',
            'desc' => 'Υποψήφιος Ιστότοπος',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'grader_a',
            'desc' => 'Αξιολογητής Α',
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'grader_b',
            'desc' => 'Αξιολογητής Β',
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'member',
            'desc' => 'Μέλος Επιτροπής',
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'user',
            'desc' => 'Χρήστης',
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'admin',
            'desc' => 'Διαχειριστής',
        ]);
        DB::table('roles')->insert([
            'id' => 7,
            'name' => 'ninja',
            'desc' => 'Ninja',
        ]);

    }
}
