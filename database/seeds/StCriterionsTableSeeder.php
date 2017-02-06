<?php

use Illuminate\Database\Seeder;

class StCriterionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('st_criterions')->insert([

            'main_title' => 'ΑΛΛΗΛΕΠΙΔΡΑΣΗ ΜΕ ΤΟΥΣ ΧΡΗΣΤΕΣ',

            'stk1_title' => '
                α) Ο ιστότοπος παρέχει τουλάχιστον ένα διαθέσιμο τρόπο επικοινωνίας με τους διαχειριστές (π.χ. φόρμα επικοινωνίας, email διαχειριστών).<br>
                β) Στον ιστότοπο υπάρχει σελίδα βοήθειας και συχνών ερωτήσεων, (FAQ), με δυνατότητα υποβολής ερωτήσεων.<br>
                γ) Ο ιστότοπος παρέχει τη δυνατότητα αποστολής προσωπικών ενημερώσεων (π.χ. mail, newsletters, RSS) στους ενδιαφερόμενους αναγνώστες.<br> 
                δ) Ο ιστότοπος παρέχει τη δυνατότητα στους χρήστες να μοιράζουν περιεχόμενο σε κοινωνικά δίκτυα (π.χ. Facebook, Twitter, Google+).
            ',

            'stk2_title' => 'Σε τι βαθμό θεωρείτε ότι ο ιστότοπος λειτουργεί ως κοινότητα μάθησης, δηλαδή υπάρχουν εγγεγραμμένα μέλη ή τακτικοί σχολιαστές των άρθρων, γίνονται συζητήσεις επί αυτών και σύνθεση επιπλέον υλικού με βάση το σχολιασμό.',

            'stk3_title' => '
                α) Ο ιστότοπος δίνει τη δυνατότητα δημιουργίας λογαριασμού με τον χρήστη, προκειμένου ο χρήστης να έχει πρόσβαση σε εξειδικευμένο υλικό που συνδέει άλλους χρήστες (π.χ. μαθητές ενός τμήματος, γονείς και κηδεμόνες).<br>
                β) Ο ιστότοπος παρέχει λειτουργίες που διευκολύνουν την επικοινωνία μεταξύ των επισκεπτών, εκπαιδευτικών ή/και μαθητών (π.χ. forum, chat). Το Forum είναι πλούσιο σε θεματικές και βοηθάει εν γένει στην επικοινωνία και χρηστικότητα των πληροφοριών του ιστότοπου;<br> 
                γ) Ο ιστότοπος προωθεί την ενεργό συμμετοχή των αναγνωστών (π.χ. δυνατότητα σχολιασμού, ανεβάσματος υλικού).<br>
                δ) Στον ιστότοπο δίνεται σε εγγεγραμμένο χρήστη η δυνατότητα επεξεργασίας υλικού που έχει δημιουργηθεί από άλλον χρήστη.
            ',

            'stk4_title' => 'Υπάρχει δυνατότητα αξιολόγησης του ιστότοπου από τον επισκέπτη-χρήστη για την εν γένει ποιότητά του, το σχεδιασμό και τις πληροφορίες που παρέχει στους αναγνώστες; Γενικότερα υπάρχει αλληλεπίδραση με τους χρήστες ως προς τη βελτίωση αναλυτικά του ιστότοπου;',

            'stk1_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'stk1_2_title' => 'Καλύπτεται ένα στοιχείο',
            'stk1_3_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'stk1_4_title' => 'Καλύπτονται έως τρία στοιχεία',
            'stk1_5_title' => 'Καλύπτονται όλα τα στοιχεία.',

            'stk2_1_title' => 'Καθόλου',
            'stk2_2_title' => 'Λίγο',
            'stk2_3_title' => 'Μέτρια',
            'stk2_4_title' => 'Πολύ',
            'stk2_5_title' => 'Πάρα πολύ',            

            'stk3_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'stk3_2_title' => 'Καλύπτεται ένα στοιχείο',
            'stk3_3_title' => 'Καλύπτονται έως δύο στοιχεία.',
            'stk3_4_title' => 'Καλύπτονται έως τρία στοιχεία',
            'stk3_5_title' => 'Καλύπτονται όλα τα στοιχεία.',

            'stk4_1_title' => 'Καθόλου',
            'stk4_2_title' => 'Λίγο',
            'stk4_3_title' => 'Μέτρια',
            'stk4_4_title' => 'Πολύ',
            'stk4_5_title' => 'Πάρα πολύ',

            'weight' => 20,
            'stk1_weight' => 28,
            'stk2_weight' => 32,
            'stk3_weight' => 20,
            'stk4_weight' => 20,
            
        ]);
    }
}