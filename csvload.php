<?php

require_once('parsecsv.lib.php');

function strrevpos($instr, $needle)
{
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};

$target_path = "upload/";

$target_path = $target_path . basename($_FILES['uploadedfile']['name']);

 if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
   $filename = $_FILES['uploadedfile']['name'];

 }
 else {
   echo "There was an error uploading the file, please try again!";
 }

$csv = array_map('str_getcsv', file('upload/SalesHistory.csv'));
array_shift($csv);
array_shift($csv);
array_shift($csv);
array_pop($csv);
array_pop($csv);
array_pop($csv);



foreach ($csv as $column_ebay) {

  $a = count($column_ebay);
  if($a == 53 || $a == 48) {

  } else {
    print '<h1>ERROR ON ROW CHECK VALIDATION CSV</h1>';
    return;
  }

  foreach ($column_ebay as $nr_column => $var) {
    switch ($nr_column) {

        case 0:								                            //sprawdzenie 1 kolumny
            $Contents[] = $var;
            break;

        case 2:                                                         //sprawdzenie 3 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                     // check if existing
                $var = substr($var, 0, 30);                 // add if missing
                $Address_line_1[] = $var;
                $Receiver[]=$var;
            }
            else {
                $Address_line_1[] = $var;
                $Receiver[]=$var;
            }
            break;

        case 5:                                                        //sprawdzenie 6 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_2_alt[] = $var;
            }
            else {
                $Address_line_2_alt[] = $var;
            }
            break;

        case 6:                                                        //sprawdzenie 7 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_3_alt[] = $var;
            }
            else {
                $Address_line_3_alt[] = $var;
            }
            break;

        case 7:                                                        //sprawdzenie 8 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_4_alt[] = $var;
            }
            else {
                $Address_line_4_alt[] = $var;
            }
            break;

        case 9:                                                        //sprawdzenie 10 kolumny
            $var = str_replace(",", ".", $var);
            $var = str_replace(' ', '', $var);
            $var = strtoupper($var);
            if (strlen($var) > 15) {                                    // znaki required
                $var = substr($var, 0, 15);                // znaki required
                $Postcode_alt[] = 'ERROR';
            }
            else {
                $Postcode_alt[] = $var;
            }
            break;

        case 13:                                                        //sprawdzenie 14 kolumny
            $Reference[] = $var;
            if (!is_bool(strrevpos($var, 'L'))) {
                $key[] = substr($var, strpos($var, 'L') + strlen('L'));
                $shape[] = substr($var, 0 , strpos($var, 'L'));
            } else {
                $key[] = substr($var, strpos($var, 'R') + strlen('R'));
                $shape[] = substr($var, 0 , strpos($var, 'R'));
            }
            break;

        case 14:                                                        //sprawdzenie 15 kolumny
                $Quantity[] = $var;
            break;

        case 46:                                                        //sprawdzenie 47 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_2[] = $var;
            }
            else {
                $Address_line_2[] = $var;
            }
            break;

        case 47:                                                        //sprawdzenie 48 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_3[] = $var;
            }
            else {
                $Address_line_3[] = $var;
            }
            break;

        case 48:                                                        //sprawdzenie 49 kolumny
            $var = str_replace("&amp;", "and", $var);
            $var = str_replace(",", ".", $var);
            if (strlen($var) > 30) {                                    // znaki required
                $var = substr($var, 0, 30);                // znaki required
                $Address_line_4[] = $var;
            }
            else {
                $Address_line_4[] = $var;
            }
            break;

        case 50:                                                        //sprawdzenie 51 kolumny
            $var = str_replace(",", ".", $var);
            $var = str_replace(' ', '', $var);
            $var = strtoupper($var);
            if (strlen($var) > 15) {                                    // znaki required
                $var = substr($var, 0, 15);                // znaki required
                $Postcode[] = 'ERROR';
            }
            else {
                $Postcode[] = $var;
            }
            break;

        case 51:                                                        //sprawdzenie 52 kolumny

            if (strlen($var) < 3) {
                $Country_code[] = 'ERROR';
            }
            else {
                $ISO_codes = array("Aruba" => "ABW" ,
                    "Afghanistan" => "AFG" ,
                    "Angola" => "AGO" ,
                    "Anguilla" => "AIA" ,
                    "Åland Islands" => "ALA" ,
                    "Albania" => "ALB" ,
                    "Andorra" => "AND" ,
                    "United Arab Emirates" => "ARE" ,
                    "Argentina" => "ARG" ,
                    "Armenia" => "ARM" ,
                    "American Samoa" => "ASM" ,
                    "Antarctica" => "ATA" ,
                    "French Southern Territories" => "ATF" ,
                    "Antigua and Barbuda" => "ATG" ,
                    "Australia" => "AUS" ,
                    "Austria" => "AUT" ,
                    "Azerbaijan" => "AZE" ,
                    "Burundi" => "BDI" ,
                    "Belgium" => "BEL" ,
                    "Benin" => "BEN" ,
                    "Bonaire, Sint Eustatius and Saba" => "BES" ,
                    "Burkina Faso" => "BFA" ,
                    "Bangladesh" => "BGD" ,
                    "Bulgaria" => "BGR" ,
                    "Bahrain" => "BHR" ,
                    "Bahamas" => "BHS" ,
                    "Bosnia and Herzegovina" => "BIH" ,
                    "Saint Barthélemy" => "BLM" ,
                    "Belarus" => "BLR" ,
                    "Belize" => "BLZ" ,
                    "Bermuda" => "BMU" ,
                    "Bolivia, Plurinational State of" => "BOL" ,
                    "Brazil" => "BRA" ,
                    "Barbados" => "BRB" ,
                    "Brunei Darussalam" => "BRN" ,
                    "Bhutan" => "BTN" ,
                    "Bouvet Island" => "BVT" ,
                    "Botswana" => "BWA" ,
                    "Central African Republic" => "CAF" ,
                    "Canada" => "CAN" ,
                    "Cocos (Keeling) Islands" => "CCK" ,
                    "Switzerland" => "CHE" ,
                    "Chile" => "CHL" ,
                    "China" => "CHN" ,
                    "Côte d'Ivoire" => "CIV" ,
                    "Cameroon" => "CMR" ,
                    "Congo, the Democratic Republic of the" => "COD" ,
                    "Congo" => "COG" ,
                    "Cook Islands" => "COK" ,
                    "Colombia" => "COL" ,
                    "Comoros" => "COM" ,
                    "Cabo Verde" => "CPV" ,
                    "Costa Rica" => "CRI" ,
                    "Cuba" => "CUB" ,
                    "Curaçao" => "CUW" ,
                    "Christmas Island" => "CXR" ,
                    "Cayman Islands" => "CYM" ,
                    "Cyprus" => "CYP" ,
                    "Czechia" => "CZE" ,
                    "Germany" => "DEU" ,
                    "Djibouti" => "DJI" ,
                    "Dominica" => "DMA" ,
                    "Denmark" => "DNK" ,
                    "Dominican Republic" => "DOM" ,
                    "Algeria" => "DZA" ,
                    "Ecuador" => "ECU" ,
                    "Egypt" => "EGY" ,
                    "Eritrea" => "ERI" ,
                    "Western Sahara" => "ESH" ,
                    "Spain" => "ESP" ,
                    "Estonia" => "EST" ,
                    "Ethiopia" => "ETH" ,
                    "Finland" => "FIN" ,
                    "Fiji" => "FJI" ,
                    "Falkland Islands (Malvinas)" => "FLK" ,
                    "France" => "FRA" ,
                    "Faroe Islands" => "FRO" ,
                    "Micronesia, Federated States of" => "FSM" ,
                    "Gabon" => "GAB" ,
                    "United Kingdom" => "GBR" ,
                    "Georgia" => "GEO" ,
                    "Guernsey" => "GGY" ,
                    "Ghana" => "GHA" ,
                    "Gibraltar" => "GIB" ,
                    "Guinea" => "GIN" ,
                    "Guadeloupe" => "GLP" ,
                    "Gambia" => "GMB" ,
                    "Guinea-Bissau" => "GNB" ,
                    "Equatorial Guinea" => "GNQ" ,
                    "Greece" => "GRC" ,
                    "Grenada" => "GRD" ,
                    "Greenland" => "GRL" ,
                    "Guatemala" => "GTM" ,
                    "French Guiana" => "GUF" ,
                    "Guam" => "GUM" ,
                    "Guyana" => "GUY" ,
                    "Hong Kong" => "HKG" ,
                    "Heard Island and McDonald Islands" => "HMD" ,
                    "Honduras" => "HND" ,
                    "Croatia" => "HRV" ,
                    "Haiti" => "HTI" ,
                    "Hungary" => "HUN" ,
                    "Indonesia" => "IDN" ,
                    "Isle of Man" => "IMN" ,
                    "India" => "IND" ,
                    "British Indian Ocean Territory" => "IOT" ,
                    "Ireland" => "IRL" ,
                    "Iran, Islamic Republic of" => "IRN" ,
                    "Iraq" => "IRQ" ,
                    "Iceland" => "ISL" ,
                    "Israel" => "ISR" ,
                    "Italy" => "ITA" ,
                    "Jamaica" => "JAM" ,
                    "Jersey" => "JEY" ,
                    "Jordan" => "JOR" ,
                    "Japan" => "JPN" ,
                    "Kazakhstan" => "KAZ" ,
                    "Kenya" => "KEN" ,
                    "Kyrgyzstan" => "KGZ" ,
                    "Cambodia" => "KHM" ,
                    "Kiribati" => "KIR" ,
                    "Saint Kitts and Nevis" => "KNA" ,
                    "Korea, Republic of" => "KOR" ,
                    "Kuwait" => "KWT" ,
                    "Lao People's Democratic Republic" => "LAO" ,
                    "Lebanon" => "LBN" ,
                    "Liberia" => "LBR" ,
                    "Libya" => "LBY" ,
                    "Saint Lucia" => "LCA" ,
                    "Liechtenstein" => "LIE" ,
                    "Sri Lanka" => "LKA" ,
                    "Lesotho" => "LSO" ,
                    "Lithuania" => "LTU" ,
                    "Luxembourg" => "LUX" ,
                    "Latvia" => "LVA" ,
                    "Macao" => "MAC" ,
                    "Saint Martin (French part)" => "MAF" ,
                    "Morocco" => "MAR" ,
                    "Monaco" => "MCO" ,
                    "Moldova, Republic of" => "MDA" ,
                    "Madagascar" => "MDG" ,
                    "Maldives" => "MDV" ,
                    "Mexico" => "MEX" ,
                    "Marshall Islands" => "MHL" ,
                    "Macedonia, the former Yugoslav Republic of" => "MKD" ,
                    "Mali" => "MLI" ,
                    "Malta" => "MLT" ,
                    "Myanmar" => "MMR" ,
                    "Montenegro" => "MNE" ,
                    "Mongolia" => "MNG" ,
                    "Northern Mariana Islands" => "MNP" ,
                    "Mozambique" => "MOZ" ,
                    "Mauritania" => "MRT" ,
                    "Montserrat" => "MSR" ,
                    "Martinique" => "MTQ" ,
                    "Mauritius" => "MUS" ,
                    "Malawi" => "MWI" ,
                    "Malaysia" => "MYS" ,
                    "Mayotte" => "MYT" ,
                    "Namibia" => "NAM" ,
                    "New Caledonia" => "NCL" ,
                    "Niger" => "NER" ,
                    "Norfolk Island" => "NFK" ,
                    "Nigeria" => "NGA" ,
                    "Nicaragua" => "NIC" ,
                    "Niue" => "NIU" ,
                    "Netherlands" => "NLD" ,
                    "Norway" => "NOR" ,
                    "Nepal" => "NPL" ,
                    "Nauru" => "NRU" ,
                    "New Zealand" => "NZL" ,
                    "Oman" => "OMN" ,
                    "Pakistan" => "PAK" ,
                    "Panama" => "PAN" ,
                    "Pitcairn" => "PCN" ,
                    "Peru" => "PER" ,
                    "Philippines" => "PHL" ,
                    "Palau" => "PLW" ,
                    "Papua New Guinea" => "PNG" ,
                    "Poland" => "POL" ,
                    "Puerto Rico" => "PRI" ,
                    "Korea, Democratic People's Republic of" => "PRK" ,
                    "Portugal" => "PRT" ,
                    "Paraguay" => "PRY" ,
                    "Palestine, State of" => "PSE" ,
                    "French Polynesia" => "PYF" ,
                    "Qatar" => "QAT" ,
                    "Réunion" => "REU" ,
                    "Romania" => "ROU" ,
                    "Russian Federation" => "RUS" ,
                    "Rwanda" => "RWA" ,
                    "Saudi Arabia" => "SAU" ,
                    "Sudan" => "SDN" ,
                    "Senegal" => "SEN" ,
                    "Singapore" => "SGP" ,
                    "South Georgia and the South Sandwich Islands" => "SGS" ,
                    "Saint Helena, Ascension and Tristan da Cunha" => "SHN" ,
                    "Svalbard and Jan Mayen" => "SJM" ,
                    "Solomon Islands" => "SLB" ,
                    "Sierra Leone" => "SLE" ,
                    "El Salvador" => "SLV" ,
                    "San Marino" => "SMR" ,
                    "Somalia" => "SOM" ,
                    "Saint Pierre and Miquelon" => "SPM" ,
                    "Serbia" => "SRB" ,
                    "South Sudan" => "SSD" ,
                    "Sao Tome and Principe" => "STP" ,
                    "Suriname" => "SUR" ,
                    "Slovakia" => "SVK" ,
                    "Slovenia" => "SVN" ,
                    "Sweden" => "SWE" ,
                    "Eswatini" => "SWZ" ,
                    "Sint Maarten (Dutch part)" => "SXM" ,
                    "Seychelles" => "SYC" ,
                    "Syrian Arab Republic" => "SYR" ,
                    "Turks and Caicos Islands" => "TCA" ,
                    "Chad" => "TCD" ,
                    "Togo" => "TGO" ,
                    "Thailand" => "THA" ,
                    "Tajikistan" => "TJK" ,
                    "Tokelau" => "TKL" ,
                    "Turkmenistan" => "TKM" ,
                    "Timor-Leste" => "TLS" ,
                    "Tonga" => "TON" ,
                    "Trinidad and Tobago" => "TTO" ,
                    "Tunisia" => "TUN" ,
                    "Turkey" => "TUR" ,
                    "Tuvalu" => "TUV" ,
                    "Taiwan, Province of China" => "TWN" ,
                    "Tanzania, United Republic of" => "TZA" ,
                    "Uganda" => "UGA" ,
                    "Ukraine" => "UKR" ,
                    "United States Minor Outlying Islands" => "UMI" ,
                    "Uruguay" => "URY" ,
                    "United States of America" => "USA" ,
                    "Uzbekistan" => "UZB" ,
                    "Holy See" => "VAT" ,
                    "Saint Vincent and the Grenadines" => "VCT" ,
                    "Venezuela, Bolivarian Republic of" => "VEN" ,
                    "Virgin Islands, British" => "VGB" ,
                    "Virgin Islands, U.S." => "VIR" ,
                    "Viet Nam" => "VNM" ,
                    "Vanuatu" => "VUT" ,
                    "Wallis and Futuna" => "WLF" ,
                    "Samoa" => "WSM" ,
                    "Yemen" => "YEM" ,
                    "South Africa" => "ZAF" ,
                    "Zambia" => "ZMB" ,
                    "Zimbabwe" => "ZWE" );
                $Country_code[] = $ISO_codes[$var];
            }

    }

  }

}

$print = "NAME;ZUSATZ;STRASSE;NUMMER;PLZ;STADT;LAND;ADRESS_TYP;SHAPE;QUANTITY;SORT
Hightecpl; ;An der Pohlitzer Mühle;1;15890;Eisenhüttenstadt;DEU;HOUSE \r\n";

$nowycsv = array(


    0 => $Receiver,
    1 => $Address_line_3,
    2 => $Address_line_2,
    4 => $Postcode,
    5 => $Address_line_4,
    6 => $Country_code,
    7 => 'HOUSE',
    8 => $Reference,
    9 => $Quantity,
    10 => $shape

);
$count_row = count($csv);

$p = (";");

for ($i=0; $i < $count_row; $i++) {

    if ($Receiver[$i] != '') {
      $name= '';
      $name = explode(" ", $Receiver[$i] );

      if (empty($Address_line_2[$i])) {
          $Address_line_2[$i] = $Address_line_2_alt[$i];
      }

      if (empty($Address_line_3[$i])) {
          $Address_line_3[$i] = $Address_line_3_alt[$i];
      }

      if (empty($Address_line_4[$i])) {
          $Address_line_4[$i] = $Address_line_4_alt[$i];
      }

      if (empty($Postcode4[$i])) {
          $Postcode[$i] = $Postcode_alt[$i];
      }

    $row1 = [
        $Receiver[$i] . $p .
        $Address_line_3[$i] . $p .
        $Address_line_2[$i] . $p . $p .
        $Postcode[$i] . $p .
        $Address_line_4[$i] . $p .
        $Country_code[$i] . $p .
        'HOUSE' . $p .
        $Reference[$i] . $p .
        $Quantity[$i] . $p .
        $shape[$i]
        ];

        $sortkey[$shape[$i]][$i] = $row1;
  }
}

ksort($sortkey);
foreach ($sortkey as $item) {
    foreach ($item as $subitem) {
        foreach ($subitem as $value) {
            $print .= $value . $p;
        }
        $print .= ("\r\n");
    }
}

date_default_timezone_set('UTC');
$r = date("d-m-Y H.i");

$fp = fopen("upload/filex.csv", 'w');

fwrite($fp, $print);

fclose($fp);

unlink('upload/SalesHistory.csv');

$unsorted = ("upload/filex.csv");

$csv = new parseCSV($unsorted); // create new parseCSV object.

$csv->delimiter = ";";   // delimited
$csv->parse($finalfile);  // parse

$finalfile = ("upload/filex" . $r . ".csv");

$csv->save($finalfile);  //save

?>

<head>
</head>

<body>
<div style="width:960px; margin:20px auto;">

  <h2><a style="     background: none repeat scroll 0 0 black;
    border-radius: 30px;
    box-shadow: 9px 3px 7px #000;
    color: #fff;
    display: block;
    height: 40px;
    text-align: center;
    width: 200px;" href="<?php print $finalfile; ?>"> Generated CSV<a></h2>

</div>
<h2>Congratulations! File has been created succesfully.</h2>
<h1><a href="https://images.automirrors.co.uk/ebay/deutschepost/">BACK!</a></h1>
<img width="600px" src="https://images.automirrors.co.uk/ebay/deutschepost/logo.jpg">
<?php sleep(5);
echo "SUCCESS!";
?>
</body>