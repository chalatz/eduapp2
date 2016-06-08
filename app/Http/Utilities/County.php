<?php

namespace App\Http\Utilities;

class County {

  protected static $counties = [

    ['id' => '1','county_name' => 'Βορείου Τομέα','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '2','county_name' => 'Δυτικού Τομέα','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '3','county_name' => 'Κεντρικού Τομέα','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '4','county_name' => 'Νοτίου Τομέα','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '5','county_name' => 'Πειραιώς','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '6','county_name' => 'Νήσων','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '7','county_name' => 'Ανατολικής Αττικής','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '8','county_name' => 'Δυτικής Αττικής','district_id' => '1','district_name' => 'Αττική'],
    ['id' => '9','county_name' => 'Ικαρίας','district_id' => '2','district_name' => 'Βόρειο Αιγαίο'],
    ['id' => '10','county_name' => 'Λέσβου','district_id' => '2','district_name' => 'Βόρειο Αιγαίο'],
    ['id' => '11','county_name' => 'Λήμνου','district_id' => '2','district_name' => 'Βόρειο Αιγαίο'],
    ['id' => '12','county_name' => 'Σάμου','district_id' => '2','district_name' => 'Βόρειο Αιγαίο'],
    ['id' => '13','county_name' => 'Χίου','district_id' => '2','district_name' => 'Βόρειο Αιγαίο'],
    ['id' => '14','county_name' => 'Μυκόνου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '15','county_name' => 'Θήρας','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '16','county_name' => 'Νάξου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '17','county_name' => 'Καλύμνου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '18','county_name' => 'Πάρου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '19','county_name' => 'Καρπάθου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '20','county_name' => 'Ρόδου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '21','county_name' => 'Κέας-Κύθνου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '22','county_name' => 'Σύρου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '23','county_name' => 'Κω','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '24','county_name' => 'Τήνου  ','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '25','county_name' => 'Άνδρου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '26','county_name' => 'Μήλου','district_id' => '3','district_name' => 'Νότιο Αιγαίο'],
    ['id' => '27','county_name' => 'Αιτωλοακαρνανίας','district_id' => '4','district_name' => 'Δυτική Ελλάδα'],
    ['id' => '28','county_name' => 'Αχαΐας','district_id' => '4','district_name' => 'Δυτική Ελλάδα'],
    ['id' => '29','county_name' => 'Ηλείας','district_id' => '4','district_name' => 'Δυτική Ελλάδα'],
    ['id' => '30','county_name' => 'Καρδίτσας','district_id' => '5','district_name' => 'Θεσσαλία'],
    ['id' => '31','county_name' => 'Λάρισας','district_id' => '5','district_name' => 'Θεσσαλία'],
    ['id' => '32','county_name' => 'Μαγνησίας','district_id' => '5','district_name' => 'Θεσσαλία'],
    ['id' => '33','county_name' => 'Σποράδων','district_id' => '5','district_name' => 'Θεσσαλία'],
    ['id' => '34','county_name' => 'Τρικάλων','district_id' => '5','district_name' => 'Θεσσαλία'],
    ['id' => '35','county_name' => 'Άρτας','district_id' => '6','district_name' => 'Ήπειρος'],
    ['id' => '36','county_name' => 'Θεσπρωτίας','district_id' => '6','district_name' => 'Ήπειρος'],
    ['id' => '37','county_name' => 'Ιωαννίνων','district_id' => '6','district_name' => 'Ήπειρος'],
    ['id' => '38','county_name' => 'Πρέβεζας','district_id' => '6','district_name' => 'Ήπειρος'],
    ['id' => '39','county_name' => 'Ζακύνθου','district_id' => '7','district_name' => 'Ιόνιο'],
    ['id' => '40','county_name' => 'Ιθάκης','district_id' => '7','district_name' => 'Ιόνιο'],
    ['id' => '41','county_name' => 'Κέρκυρας','district_id' => '7','district_name' => 'Ιόνιο'],
    ['id' => '42','county_name' => 'Κεφαλληνίας','district_id' => '7','district_name' => 'Ιόνιο'],
    ['id' => '43','county_name' => 'Λευκάδας','district_id' => '7','district_name' => 'Ιόνιο'],
    ['id' => '44','county_name' => 'Ηρακλείου','district_id' => '8','district_name' => 'Κρήτη'],
    ['id' => '45','county_name' => 'Λασιθίου','district_id' => '8','district_name' => 'Κρήτη'],
    ['id' => '46','county_name' => 'Ρεθύμνης','district_id' => '8','district_name' => 'Κρήτη'],
    ['id' => '47','county_name' => 'Χανίων','district_id' => '8','district_name' => 'Κρήτη'],
    ['id' => '48','county_name' => 'Δράμας','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '49','county_name' => 'Έβρου','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '50','county_name' => 'Θάσου','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '51','county_name' => 'Καβάλας','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '52','county_name' => 'Ξάνθης','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '53','county_name' => 'Ροδόπης','district_id' => '9','district_name' => 'Ανατολική Μακεδονία και Θράκη'],
    ['id' => '54','county_name' => 'Γρεβενών','district_id' => '10','district_name' => 'Δυτική Μακεδονία'],
    ['id' => '55','county_name' => 'Καστοριάς','district_id' => '10','district_name' => 'Δυτική Μακεδονία'],
    ['id' => '56','county_name' => 'Κοζάνης','district_id' => '10','district_name' => 'Δυτική Μακεδονία'],
    ['id' => '57','county_name' => 'Φλώρινας','district_id' => '10','district_name' => 'Δυτική Μακεδονία'],
    ['id' => '58','county_name' => 'Ημαθίας','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '59','county_name' => 'Θεσσαλονίκης','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '60','county_name' => 'Κιλκίς','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '61','county_name' => 'Πελλας','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '62','county_name' => 'Πιερίας','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '63','county_name' => 'Σερρών','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '64','county_name' => 'Χαλκιδικής','district_id' => '11','district_name' => 'Κεντρική Μακεδονία'],
    ['id' => '65','county_name' => 'Αργολίδος','district_id' => '12','district_name' => 'Πελοπόννησος'],
    ['id' => '66','county_name' => 'Αρκαδίας','district_id' => '12','district_name' => 'Πελοπόννησος'],
    ['id' => '67','county_name' => 'Κορινθίας','district_id' => '12','district_name' => 'Πελοπόννησος'],
    ['id' => '68','county_name' => 'Λακωνίας','district_id' => '12','district_name' => 'Πελοπόννησος'],
    ['id' => '69','county_name' => 'Μεσσηνίας','district_id' => '12','district_name' => 'Πελοπόννησος'],
    ['id' => '70','county_name' => 'Βοιωτίας','district_id' => '13','district_name' => 'Στερεά Ελλάδα'],
    ['id' => '71','county_name' => 'Εύβοιας','district_id' => '13','district_name' => 'Στερεά Ελλάδα'],
    ['id' => '72','county_name' => 'Ευρυτανίας','district_id' => '13','district_name' => 'Στερεά Ελλάδα'],
    ['id' => '73','county_name' => 'Φθιώτιδας','district_id' => '13','district_name' => 'Στερεά Ελλάδα'],
    ['id' => '74','county_name' => 'Φωκίδας','district_id' => '13','district_name' => 'Στερεά Ελλάδα'],

  ];

  public static function all()
  {
    $counties_array =[];

    foreach(static::$counties as $county){
        $counties_array[$county['district_name']][$county['id']] = $county['county_name'];
    }

    return $counties_array = ['0' => 'Επιλέξτε Περιφερειακή Ενότητα...'] + $counties_array;
  }

}
