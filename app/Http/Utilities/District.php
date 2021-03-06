<?php

namespace App\Http\Utilities;

class District {

  protected static $districts = [

    '' => 'Επιλέξτε Περιφερειακή Διεύθυνση Εκπαίδευσης...',
    '1' => 'Αττικής',
    '2' => 'Βορείου Αιγαίου',
    '3' => 'Νοτίου Αιγαίου',
    '4' => 'Δυτικής Ελλάδας',
    '5' => 'Θεσσαλίας',
    '6' => 'Ηπείρου',
    '7' => 'Ιονίων Νήσων',
    '8' => 'Κρήτης',
    '9' => 'Ανατολικής Μακεδονίας και Θράκης',
    '10' => 'Δυτικής Μακεδονίας',
    '11' => 'Κεντρικής Μακεδονίας',
    '12' => 'Πελοποννήσου',
    '13' => 'Στερεάς Ελλάδας',
    '14' => 'Άλλη - Εκτός Ελλάδος',

  ];

  public static function all()
  {
    return static::$districts;
  }

}
