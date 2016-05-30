<?php

namespace App\Http\Utilities;

class Lang_level {

  protected static $lang_levels = [

    '' => 'Επιλέξτε Επίπεδο...',
    'A1' => 'A1 - Στοιχειώδης Γνώση',
    'A2' => 'A2 - Βασική Γνώση',
    'B1' => 'B1 - Μέτρια Γνώση',
    'B2' => 'B2 - Καλή Γνώση',
    'C1' => 'C1 - Πολύ Καλή Γνώση',
    'C2' => 'C2 - Άριστη Γνώση',

  ];

  public static function all()
  {
    return static::$lang_levels;
  }

}
