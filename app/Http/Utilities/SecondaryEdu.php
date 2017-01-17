<?php

namespace App\Http\Utilities;

class SecondaryEdu {

  protected static $secondary_schools = [

    '' => 'Επιλέξτε Είδος Σχολείου...',
    '1' => 'Γενικά Λύκεια',
    '2' => 'ΕΠΑΛ',
    '3' => 'ΕΚ',
    '4' => 'ΤΕΕ Ειδικής Αγωγής',
    '5' => 'Δημόσια και Ιδιωτικά ΙΕΚ',
    '6' => 'ΕΠΑΣ ΟΑΕΔ',

  ];

  public static function all()
  {
    return static::$secondary_schools;
  }

}
