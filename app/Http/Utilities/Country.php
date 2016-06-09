<?php

namespace App\Http\Utilities;

class Country {

  protected static $countries = [

    '1' => 'Ελλάδα',
    '2' => 'Afghanistan',
    '3' => 'Albania',
    '4' => 'Algeria',
    '5' => 'Andorra',
    '6' => 'Angola',
    '7' => 'Antigua & Deps',
    '8' => 'Argentina',
    '9' => 'Armenia',
    '10' => 'Australia',
    '11' => 'Austria',
    '12' => 'Azerbaijan',
    '13' => 'Bahamas',
    '14' => 'Bahrain',
    '15' => 'Bangladesh',
    '16' => 'Barbados',
    '17' => 'Belarus',
    '18' => 'Belgium',
    '19' => 'Belize',
    '20' => 'Benin',
    '21' => 'Bhutan',
    '22' => 'Bolivia',
    '23' => 'Bosnia Herzegovina',
    '24' => 'Botswana',
    '25' => 'Brazil',
    '26' => 'Brunei',
    '27' => 'Bulgaria',
    '28' => 'Burkina',
    '29' => 'Burundi',
    '30' => 'Cambodia',
    '31' => 'Cameroon',
    '32' => 'Canada',
    '33' => 'Cape Verde',
    '34' => 'Central African Rep',
    '35' => 'Chad',
    '36' => 'Chile',
    '37' => 'China',
    '38' => 'Colombia',
    '39' => 'Comoros',
    '40' => 'Congo',
    '41' => 'Congo {Democratic Rep}',
    '42' => 'Costa Rica',
    '43' => 'Croatia',
    '44' => 'Cuba',
    '45' => 'Cyprus',
    '46' => 'Czech Republic',
    '47' => 'Denmark',
    '48' => 'Djibouti',
    '49' => 'Dominica',
    '50' => 'Dominican Republic',
    '51' => 'East Timor',
    '52' => 'Ecuador',
    '53' => 'Egypt',
    '54' => 'El Salvador',
    '55' => 'Equatorial Guinea',
    '56' => 'Eritrea',
    '57' => 'Estonia',
    '58' => 'Ethiopia',
    '59' => 'Fiji',
    '60' => 'Finland',
    '61' => 'France',
    '62' => 'Gabon',
    '63' => 'Gambia',
    '64' => 'Georgia',
    '65' => 'Germany',
    '66' => 'Ghana',
    '67' => 'Grenada',
    '68' => 'Guatemala',
    '69' => 'Guinea',
    '70' => 'Guinea-Bissau',
    '71' => 'Guyana',
    '72' => 'Haiti',
    '73' => 'Honduras',
    '74' => 'Hungary',
    '75' => 'Iceland',
    '76' => 'India',
    '77' => 'Indonesia',
    '78' => 'Iran',
    '79' => 'Iraq',
    '80' => 'Ireland {Republic}',
    '81' => 'Israel',
    '82' => 'Italy',
    '83' => 'Ivory Coast',
    '84' => 'Jamaica',
    '85' => 'Japan',
    '86' => 'Jordan',
    '87' => 'Kazakhstan',
    '88' => 'Kenya',
    '89' => 'Kiribati',
    '90' => 'Korea North',
    '91' => 'Korea South',
    '92' => 'Kosovo',
    '93' => 'Kuwait',
    '94' => 'Kyrgyzstan',
    '95' => 'Laos',
    '96' => 'Latvia',
    '97' => 'Lebanon',
    '98' => 'Lesotho',
    '99' => 'Liberia',
    '100' => 'Libya',
    '101' => 'Liechtenstein',
    '102' => 'Lithuania',
    '103' => 'Luxembourg',
    '104' => 'Macedonia',
    '105' => 'Madagascar',
    '106' => 'Malawi',
    '107' => 'Malaysia',
    '108' => 'Maldives',
    '109' => 'Mali',
    '110' => 'Malta',
    '111' => 'Marshall Islands',
    '112' => 'Mauritania',
    '113' => 'Mauritius',
    '114' => 'Mexico',
    '115' => 'Micronesia',
    '116' => 'Moldova',
    '117' => 'Monaco',
    '118' => 'Mongolia',
    '119' => 'Montenegro',
    '120' => 'Morocco',
    '121' => 'Mozambique',
    '122' => 'Myanmar, {Burma}',
    '123' => 'Namibia',
    '124' => 'Nauru',
    '125' => 'Nepal',
    '126' => 'Netherlands',
    '127' => 'New Zealand',
    '128' => 'Nicaragua',
    '129' => 'Niger',
    '130' => 'Nigeria',
    '131' => 'Norway',
    '132' => 'Oman',
    '133' => 'Pakistan',
    '134' => 'Palau',
    '135' => 'Panama',
    '136' => 'Papua New Guinea',
    '137' => 'Paraguay',
    '138' => 'Peru',
    '139' => 'Philippines',
    '140' => 'Poland',
    '141' => 'Portugal',
    '142' => 'Qatar',
    '143' => 'Romania',
    '144' => 'Russian Federation',
    '145' => 'Rwanda',
    '146' => 'St Kitts & Nevis',
    '147' => 'St Lucia',
    '148' => 'Saint Vincent & the Grenadines',
    '149' => 'Samoa',
    '150' => 'San Marino',
    '151' => 'Sao Tome & Principe',
    '152' => 'Saudi Arabia',
    '153' => 'Senegal',
    '154' => 'Serbia',
    '155' => 'Seychelles',
    '156' => 'Sierra Leone',
    '157' => 'Singapore',
    '158' => 'Slovakia',
    '159' => 'Slovenia',
    '160' => 'Solomon Islands',
    '161' => 'Somalia',
    '162' => 'South Africa',
    '163' => 'South Sudan',
    '164' => 'Spain',
    '165' => 'Sri Lanka',
    '166' => 'Sudan',
    '167' => 'Suriname',
    '168' => 'Swaziland',
    '169' => 'Sweden',
    '170' => 'Switzerland',
    '171' => 'Syria',
    '172' => 'Taiwan',
    '173' => 'Tajikistan',
    '174' => 'Tanzania',
    '175' => 'Thailand',
    '176' => 'Togo',
    '177' => 'Tonga',
    '178' => 'Trinidad & Tobago',
    '179' => 'Tunisia',
    '180' => 'Turkey',
    '181' => 'Turkmenistan',
    '182' => 'Tuvalu',
    '183' => 'Uganda',
    '184' => 'Ukraine',
    '185' => 'United Arab Emirates',
    '186' => 'United Kingdom',
    '187' => 'United States',
    '188' => 'Uruguay',
    '189' => 'Uzbekistan',
    '190' => 'Vanuatu',
    '191' => 'Vatican City',
    '192' => 'Venezuela',
    '193' => 'Vietnam',
    '194' => 'Yemen',
    '195' => 'Zambia',
    '196' => 'Zimbabwe',

  ];

  public static function all()
  {
    return static::$countries;
  }

}
