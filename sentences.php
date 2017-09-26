<?php
include 'htmlheading.php';  // html heading
?>

<h3>Text processing. Split sentences</h3>

<?php

$otexto = "texttoprocess.txt";   // path to text to process
$fabre = fopen($otexto, 'r');
$larguratexto= filesize($otexto);

include 'substitue.php';  // function to clean text

$ototalData = fread($fabre, filesize($otexto));  // text as a string

$notagslinha = strip_tags($ototalData);     // removes html tags

$lines = preg_split("#\.#", $notagslinha);    // splits text into sentences

$lines2 = array_pop($lines);    // pops the last element of array (empty string)


$totalbr=1; // initializes sentence count.


foreach ($lines as $line)  {

$linhalida = substitue ($line);
echo "<b>$totalbr</b> $linhalida".".<br>";

$totalbr++;
}


fclose($fabre);


?>


<br><br>
<?php
include 'menubot.php';  // menu heading
?>


</body>
</html>
