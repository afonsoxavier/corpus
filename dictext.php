


<?php
include 'htmlheading.php';  // includes a heading if provided. Remove this line if none.
?>


<?php

echo "<h3>List of terms </h3>";

mb_language('uni'); mb_internal_encoding('UTF-8');

$otexto = "texttoprocess.txt";
$fabre = fopen($otexto, 'r');
$ototalData = fread($fabre, filesize($otexto));




include 'substitue.php';  // function to replace tags, html tags and double spaces



$semhtml1 = substitue($ototalData);


fclose($fabre);

/* remove utf8 mark */
$ototalData = preg_replace('/\x{EF}\x{BB}\x{BF}/','',$ototalData);


// Tokenike text and print save terms as an array;



$listatermos = listwords($semhtml1);  // calls a function to split the text in words and get an array


$listatermos= array_map ("strtolower",$listatermos);

$numtotal = count($listatermos);

echo "A total of <b>$numtotal</b> word units have been processed. <br><br>";

$i=1;

foreach ($listatermos as $termoimp) {

	echo "term $i = $termoimp <br />";
$i++;
}






?>

<?php
include 'menubot.php';  //  html for menu if provided. Remove this line if none.
?>
