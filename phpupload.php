<?php

include 'vendor/autoload.php';

require_once('parsecsv.lib.php');

$parser = new \Smalot\PdfParser\Parser();
$pdf = $parser->parseFile('upload/pdf.pdf');

// Get CSV
$csv = array_map('str_getcsv', file('upload/filex.csv'));
$count_row = count($csv);

// Retrieve all pages from the pdf file.
$pages  = $pdf->getPages();
$data_ar = array();

// Loop over each page to extract text.
foreach ($pages as $key => $page) {
    $text = $page->getText();
    $data_ar[$key] = $text;
}

// Search for text before first delimeter in CSV
$i=2;
while ($i<$count_row) {
    $value = substr ('$csv[$i][0]',0, strpos ('$csv[$i][0]', ';'));

    echo $csv[$i][0];
    $i++;
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