<?php
include 'htmlheading.php';
?>


<h3>List of terms </h3>

<?php
mb_language('uni'); mb_internal_encoding('UTF-8');
$otexto = "texttoprocess.txt";
$fabre = fopen($otexto, 'r');
$ototalData = fread($fabre, filesize($otexto));
/* remove utf8 mark */
$ototalData = preg_replace('/\x{EF}\x{BB}\x{BF}/','',$ototalData);

include 'substitue.php';



function redondea($sf,$numero){   // rounds a number to sf significative figures
$redondeado = round ($numero, floor ($sf - log10($numero)));  
return ($redondeado);
}





$semhtml1 = substitue($ototalData);  // get the parsed document.

$semhtml2 = strtolower($semhtml1); // all words lowercase.

fclose($fabre);



// Print a list of words as members of an array;



$listatermos = listwords($semhtml2);  // we call the function to split the text in words and get an array


$numtotal = count($listatermos);  // this is the total of units;


echo "A total of <b>$numtotal</b> word units have been processed. <br><br>";


/* get a list of unique terms and their number of occurrences. Check that both lists have the same number of results */


$termosunicos = array_unique($listatermos); // only unique terms
$termosunicosfreq = array_count_values ($listatermos);   // count frequency of unique elements.



$unicos = count($termosunicos);

$unicos2 = count($termosunicosfreq);



if ($unicos == $unicos2)
{
echo "A total of  <b>$unicos</b> unique terms have been extracted.<br><br>";

} 

else {

echo "A total of  <b>$unicos</b> unique terms using arrayunique have been extracted and <b>$unicos2</b> using array_count <br><br>";

}



/* Rearrange the array from high to low */


$novofreq = arsort ($termosunicosfreq);



/* Print all the terms */

$i = 1;


foreach ($termosunicosfreq as $termo => $freq ) {
$ocurrence= "occurrence";

if ($freq >1) {
$ocurrence= "occurrences";

}


$freqtext = $freq / $numtotal;  // Relative frequency.

$freqtextround = redondea (4, $freqtext);  // calls redondea function to round relative frequency 


	echo "term $i = <b> $termo </b> has <b>$freq</b> $ocurrence. Relative frequency: <b>$freqtextround</b>. <br/>";
$i++;
}


include 'menubot.php';
?>


</body>
</html>
