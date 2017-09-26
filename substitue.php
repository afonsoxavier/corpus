<?php 


function substitue ($linha)  // replaces html tags, UTF characters and double spaces.

{
$substituir = array ('#<[^>]+>#', "/[^a-zA-Z0-9\s]/", '#(\\s+)#',);

$substituido = array (' ', ' ', ' ');

$linhare = preg_replace($substituir, $substituido, $linha);

return ($linhare);

}


function listwords ($filetoindex) // returns and array with a list of words split by whitespace.

{

$termos1 = trim ($filetoindex);
$termos= explode (" ", $termos1);
return ($termos);
}

 ?>