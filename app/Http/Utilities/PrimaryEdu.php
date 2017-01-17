<?php

namespace App\Http\Utilities;

class PrimaryEdu {

  protected static $primary_schools = [

    '' => 'Επιλέξτε Είδος Σχολείου...',
    '1' => 'Νηπιαγωγεία',
    '2' => 'Δημοτικά Σχολεία',
    '3' => 'Ειδικά Δημοτικά Σχολεία',

  ];

  public static function all()
  {
    return static::$primary_schools;
  }

}
