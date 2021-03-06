<?php

namespace App\Http\Utilities;

class Category {

  protected static $categories = [

    '' => 'Επιλέξτε Κατηγορία...',
    '1' => '1. Νηπιαγωγεία, Δημοτικά Σχολεία, Δημοτικά Ειδικά Σχολεία',
    '2' => '2. Γυμνάσια, ΕΕΕΕΚ, ΣΔΕ',
    '3' => '3. Γενικά Λύκεια, ΕΠΑΛ, ΕΚ, ΤΕΕ Ειδικής Αγωγής, Δημόσια και Ιδιωτικά ΙΕΚ, ΕΠΑΣ ΟΑΕΔ',
    '4' => '4. Υποστηρικτικές δομές εκπαίδευσης **',
    '5' => '5. Διοικητικές μονάδες Διευθύνσεων Εκπαίδευσης και Περιφερειακών Διευθύνσεων Εκπαίδευσης, ΠΕΚ',
    '6' => '6. Προσωπικοί ιστότοποι ατομικοί ή ομάδων εκπαιδευτικών',

  ];

  public static function all()
  {
    return static::$categories;
  }

}
