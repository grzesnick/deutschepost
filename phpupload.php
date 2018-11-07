<?php

include 'vendor/autoload.php';

require_once('parsecsv.lib.php');

function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};

function after ($this_char, $inthat)
{
    if (!is_bool(strpos($inthat, $this_char)))
        return substr($inthat, strpos($inthat,$this_char)+strlen($this_char));
};

function after_last ($this_char, $inthat)
{
    if (!is_bool(strrevpos($inthat, $this_char)))
        return substr($inthat, strrevpos($inthat, $this_char)+strlen($this_char));
};

function before ($this_char, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $this_char));
};

$parser = new \Smalot\PdfParser\Parser();
$pdf = $parser->parseFile('upload/pdf.pdf');

// Retrieve all pages from the pdf file.
$pages = $pdf->getPages();
$data_ar = array();
// Loop over each page to extract text.
foreach ($pages as $key => $page) {
    $text = $page->getText();
    $data_ar[$key] = after_last('TTENSTADT',$text);
    echo $data_ar[$key];
    echo "<br>";
}

// Get CSV
$csv = array_map('str_getcsv', file('upload/filex.csv'));


$count_row = count($csv);
$i=2;
$k=0;
while ($i<$count_row) {
    echo $csv[$i][0];
    $csv_ar[$k]=$csv[$i][0];
    echo "<br>";
    $i++;
    $k++;
}

// Search for values in CSV
foreach ($data_ar as $data_value){
    $data_value_a = before (" ", $data_value);
    $data_value_b = after (" ", $data_value);
    echo $data_value_a;
}

foreach ($csv_ar as $csv_value)     {
    $csv_value_a = before (" ", $csv_value);
    $csv_value_b = after (" ", $csv_value);
    echo $csv_value_a;
}



/**
 * Created by PhpStorm.
 * User: Grzegorz Adamus
 * Date: 02.11.2018
 * Time: 10:47
 */

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
    width: 200px;" href="<?php print $pdf; ?>"> Generated PHP<a></h2>

</div>
<h2>Congratulations! File has been created succesfully.</h2>
<h1><a href="https://images.automirrors.co.uk/ebay/deutschepost/">BACK!</a></h1>
<img width="600px" src="https://images.automirrors.co.uk/ebay/deutschepost/logo.jpg">
<?php sleep(5);
echo "SUCCESS!";
?>
</body>