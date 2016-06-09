<?php

namespace App\Http\Utilities;

class Language {

  protected static $languages = [

    '1' => 'Ελληνικά',
    '2' => 'Αγγλικά',
    '3' => 'Γαλλικά',
    '4' => 'Γερμανικά',
    '5' => 'Ιταλικά',

  ];

  public static function all()
  {
    return static::$languages;
  }

}
