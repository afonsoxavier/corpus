<?php
include 'htmlheading.php';
?>

<h3>List of terms with absolute frequencies and occurrence position</h3>
<?php

mb_language('uni'); mb_internal_encoding('UTF-8');

$otexto = "texttoprocess.txt";
$fabre = fopen($otexto, 'r');
$ototalData = fread($fabre, filesize($otexto));

/* remove utf8 mark */
$ototalData = preg_replace('/\x{EF}\x{BB}\x{BF}/','',$ototalData);

include 'substitue.php';

$semhtml1 = substitue($ototalData);  // get the document.
$semhtml2 = strtolower($semhtml1);

fclose($fabre);

// Print a list of words as elements of an array;

$listatermos2 = listwords($semhtml2); 

$numtotal = count($listatermos2);  // this is the total of units

/* creates a new array with first key value = 1 */

$fi=0;
for ($i=1; $i<=$numtotal; $i++)
{
$listatermos[$i] = $listatermos2[$fi];
$fi++;
}

unset($listatermos[0]);


echo "A total of <b>$numtotal</b> word units have been processed. <br><br>";

/* get a list of unique terms and their number of occurrences. Check that both lists have the same number of results */

$termosunicos = array_unique($listatermos); // only unique terms
$termosunicosocur = array_count_values ($listatermos);   // count occurrences of unique elements. The terms are keys and their occurrences are the values.

/* Statistics. For reference only */
$unicos = count($termosunicos);
$unicos2 = count($termosunicosocur);

if ($unicos == $unicos2)
{
echo "A total of  <b>$unicos</b> unique terms have been extracted.<br><br>";
} 
else {
echo "A total of  <b>$unicos</b> unique terms using arrayunique have been extracted and <b>$unicos2</b> using array_count <br><br>";
}


/* Text for occurrences page */

echo "<br>This is an ordered list of terms occurring in the text from highest frequency to lowest with pattern:<br> <b>term</b> [absolute frequency]: first occurrence;[second occurrence;][...]<br><br>";



/* Rearrange the array from high to low */
arsort ($termosunicosocur);



$cadaumtop = array_intersect ($listatermos, $termosunicos); // array with all the occurrences of the terms

foreach ($termosunicosocur as $termo=>$freq)
{
set_time_limit(30); // avoids max time execution limit
$freq = $termosunicosocur[$termo];
if ($freq >1) {
$ocurrence= "occurrences";
}

$ocortop=array_keys($cadaumtop,$termo);
$ocortopstring = implode (";", $ocortop);
echo "<b>$termo</b> [$freq]:<br> $ocortopstring<br>";

}





include 'menubot.php';
?>


</body>
</html>
