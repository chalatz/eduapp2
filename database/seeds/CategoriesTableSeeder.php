<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => '1. Νηπιαγωγεία, Δημοτικά Σχολεία, Δημοτικά Ειδικά Σχολεία',
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'name' => '2. Γυμνάσια, ΕΕΕΕΚ, ΣΔΕ',
        ]);
        DB::table('categories')->insert([
            'id' => 3,
            'name' => '3. Γενικά Λύκεια, ΕΠΑΛ, ΕΚ, ΤΕΕ Ειδικής Αγωγής',
        ]);
        DB::table('categories')->insert([
            'id' => 4,
            'name' => '4. Υποστηρικτικές δομές εκπαίδευσης **',
        ]);
        DB::table('categories')->insert([
            'id' => 5,
            'name' => '5. Διοικητικές μονάδες Διευθύνσεων Εκπαίδευσης και Περιφερειακών Διευθύνσεων Εκπαίδευσης',
        ]);
        DB::table('categories')->insert([
            'id' => 6,
            'name' => '6. Προσωπικοί ιστότοποι ατομικοί ή ομάδων εκπαιδευτικών',
        ]);

    }
}
