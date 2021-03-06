<?php

use Illuminate\Database\Seeder;

class DeltaCriterionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delta_criterions')->insert([

            'main_title' => 'ΛΕΙΤΟΥΡΓΙΚΟΤΗΤΑ ΔΙΕΠΑΦΗΣ - ΑΙΣΘΗΤΙΚΗ - ΑΛΛΗΛΕΠΙΔΡΑΣΗ (τεχνική δομή)<br>(ευκολία στην πρόσβαση, δομή-πλοήγηση, απεικόνιση, τεχνική δομή)',

            'dk1_title' => '
                α) Η χρήση εξειδικευμένου λογισμικού (πχ flash) για την πρόσβαση και την περιήγηση του ιστότοπου δεν προαπαιτείται.<br>
                β) Ο χρόνος εμφάνισης του ιστότοπου και των επιμέρους στοιχείων του (κείμενα, γραφικά κ.ά.) είναι ικανοποιητικός.<br>
                γ) Υπάρχει δυνατότητα τροποποίησης στον τρόπο προβολής του ιστότοπου (π.χ. μέγεθος κειμένου κ.ά.), ώστε να είναι αναγνώσιμος και από άτομα με ειδικές ανάγκες (ΑμεΑ).<br>
                δ) Οι σύνδεσμοι και οι εικόνες διαθέτουν alternative text, ώστε να είναι αναγνώσιμες και από τα προγράμματα ανάγνωσης ιστότοπων και κατανοητές από άτομα με ειδικές ανάγκες (ΑμεΑ).<br>
                ε) Ο ιστότοπος είναι διαθέσιμος και σε άλλη γλώσσα (εκτός της ελληνικής).
            ',

            'dk2_title' => '
                α) Υπάρχει η δυνατότητα εσωτερικής αναζήτησης στο περιεχόμενο του ιστότοπου (π.χ. χάρτης πλοήγησης κ.ά).<br>
                β) Η πλοήγηση στις σελίδες είναι λογικά οργανωμένη, ευκρινής και κατανοητή, (Breadcrumb navigation).<br>
                γ) Η αρχική σελίδα είναι διαθέσιμη από κάθε άλλη εσωτερική σελίδα.<br>
                δ) Η έκταση κάθε σελίδας δεν είναι πολύ μεγάλη ώστε το scroll down να είναι μεγάλο και κουραστικό.<br>
                ε) Υπάρχουν υπερσυνδέσεις άλλων ιστότοπων προς τον παρόντα (μπορεί να διαπιστωθεί με αναζήτηση για τη σελίδα αυτή στο google).
            ',

            'dk3_title' => '
                α) Τα κείμενα δεν έχουν συντακτικά και ορθογραφικά λάθη.<br>
                β) Ο τρόπος εμφάνισης των κειμένων διευκολύνει στην πρόσβαση της πληροφορίας.<br>
                γ) Η γραμματοσειρά των κειμένων είναι ευκρινής και το μέγεθος ποικίλει κατάλληλα ανάλογα με τη χρήση.<br>
                δ) Χρησιμοποιούνται λιγότερες από τρεις γραμματοσειρές και υπάρχει συνέπεια ως προς τον τρόπο χρήσης τους.<br>
                ε) Το χρώμα των γραμμάτων βοηθά την αναγνωσιμότητα.
            ',

            'dk4_title' => '
                α) Οι επιλεγμένοι χρωματισμοί αποτελούν μια ευχάριστη παλέτα, που είναι συνεπής σε όλες τις σελίδες.<br>
                β) Τα γραφικά σχετίζονται με το περιεχόμενο του ιστότοπου και εμφανίζονται σωστά χωρίς να κουράζουν τον αναγνώστη.<br>
                γ) Ο ιστότοπος έχει μία ξεκάθαρη δομημένη και εύχρηστη διάταξη, όπως στήλες για λειτουργική αναγνωσιμότητα, η οποία είναι συνεπής σε όλες τις σελίδες.<br> 
                δ) Η συνολική παρουσίαση είναι ελκυστική και παρακινεί τον αναγνώστη να μείνει στον ιστότοπο.<br>
                ε) Στον ιστότοπο περιέχονται οπτικοακουστικά στοιχεία που δεν κουράζουν και συμβάλλουν στην επαναεπισκεψιμότητα.
            ',

            'dk5_title' => '
                α) Οι διευθύνσεις όλων των ιστοσελίδων (URL) του ιστότοπου είναι με λατινικούς χαρακτήρες και είναι clean.<br>
                β) Η διεύθυνση, url, του ιστότοπου είναι εύχρηστη.<br>
                γ) Οι υπερσύνδεσμοι (links) του ιστότοπου είναι όλοι ενεργοί.<br>
                δ) Ο ιστότοπος διαθέτει εικονίδιο favicon και κατάλληλο σχεδιασμό που προσαρμόζεται σε φορητές συσκευές, (Smartphones-Tablets).<br> 
                ε) Ο ιστότοπος φαίνεται σωστά τουλάχιστον σε οθόνη 1024Χ768Χ32 bit.<br>
                στ) Στον ιστότοπο διατίθεται η δυνατότητα εκτύπωσης.
            ',

            'dk3_2_explain' => 'Τρόπος εμφάνισης των κειμένων: π.χ. στοίχιση μεταξύ τους, καθαρότητα και περιεκτικότητα, μικρές προτάσεις, μικρές παράγραφοι, τίτλοι, υπότιτλοι, λεζάντες, λίστες, τονισμένες λέξεις.',
            'dk3_3_explain' => 'Χρήση γραμματοσειράς: π.χ. τίτλοι, υπότιτλοι, κείμενα, menu, κουμπιά.',
            'dk3_4_explain' => 'Συνέπεια: π.χ. πλάγια γραφή, υπογράμμιση, κεφαλαία.',

            'dk4_2_explain' => 'Σωστή εμφάνιση γραφικών: π.χ. ανάλυση, αναλογικές διαστάσεις, χωρίς πολύπλοκα εφέ, όχι broken images, όχι μείωση κατεβάσματος σελίδας.',
            'dk4_3_explain' => 'Ξεκάθαρη δομημένη και εύχρηστη διάταξη: Είναι εύκολο να εντοπιστούν όλα τα σημαντικά στοιχεία. Λευκός χώρος, γραφικά στοιχεία ή/και ευθυγράμμιση χρησιμοποιούνται αποτελεσματικά για να οργανώσουν το υλικό.',

            'dk5_1_explain' => 'Δείτε παραδείγματα στο http://en.wikipedia.org/wiki/Semantic_URL.',
            'dk5_4_explain' => 'Favicon: μικρό εικονίδιο που εμφανίζεται στη μπάρα της διεύθυνσης του προγράμματος πλοήγησης.',

            'dk1_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',    
            'dk1_2_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'dk1_3_title' => 'Καλύπτονται έως τρία στοιχεία.',
            'dk1_4_title' => 'Καλύπτονται έως τέσσερα στοιχεία. ',
            'dk1_5_title' => 'Καλύπτονται όλα αυτά τα στοιχεία.',

            'dk2_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'dk2_2_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'dk2_3_title' => 'Καλύπτονται έως τρία στοιχεία.',
            'dk2_4_title' => 'Καλύπτονται έως τέσσερα στοιχεία. ',
            'dk2_5_title' => 'Καλύπτονται όλα αυτά τα στοιχεία.',

            'dk3_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'dk3_2_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'dk3_3_title' => 'Καλύπτονται έως τρία στοιχεία.',
            'dk3_4_title' => 'Καλύπτονται έως τέσσερα στοιχεία. ',
            'dk3_5_title' => 'Καλύπτονται όλα αυτά τα στοιχεία.',

            'dk4_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'dk4_2_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'dk4_3_title' => 'Καλύπτονται έως τρία στοιχεία.',
            'dk4_4_title' => 'Καλύπτονται έως τέσσερα στοιχεία. ',
            'dk4_5_title' => 'Καλύπτονται όλα αυτά τα στοιχεία.',

            'dk5_1_title' => 'Δεν καλύπτεται κανένα από αυτά τα στοιχεία.',
            'dk5_2_title' => 'Καλύπτονται έως δύο στοιχεία. ',
            'dk5_3_title' => 'Καλύπτονται έως τέσσεραα στοιχεία.',
            'dk5_4_title' => 'Καλύπτονται έως πέντε στοιχεία. ',
            'dk5_5_title' => 'Καλύπτονται όλα αυτά τα στοιχεία.',

            'weight' => 20,
            
            'dk1_weight' => 20,
            'dk2_weight' => 20,
            'dk3_weight' => 20,
            'dk4_weight' => 20,
            'dk5_weight' => 20,
            
        ]);
    }
}
