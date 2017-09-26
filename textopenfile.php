<?php
include 'htmlheading.php';
?>



<?php


$otexto = "texttoprocess.txt";  // An example of transformation of tags
$fabre = fopen($otexto, 'r');
$ototalData = fread($fabre, filesize($otexto));

$substitue = array (
'#﻿#',    // first line
'#<col n="#',   // column opening tag
'#<page n="#', // page opening tag
'#">#' ,  //end of opening tag
'#</col>#', // closing column tag
'#</page>#',  // closing page
'#\|#',        // words written together
'#\s+\+\s+#m' // broken word at the end of line
);

$substituido = array (
'<h3>Text', // first line
'<b>Column:</b>', // new column
'<b>Page:</b>',  // new page
'<br>',  //  begining of page and column
'<br><br>',  // end of column
'<hr>',  // end of page
' ', // splits words written together 
'-'  // marks word split in two lines
);

echo preg_replace($substitue, $substituido, $ototalData);

fclose($fabre);


?>


<?php
include 'menubot.php';
?>


</body>
</html>
