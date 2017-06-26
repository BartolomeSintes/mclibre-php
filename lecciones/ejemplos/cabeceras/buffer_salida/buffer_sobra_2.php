<?php
$buffer = 100;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>\n";
print "<p><a href=\"buffer_sobra_1.php\">Volver al principio</a></p>\n";
header("location:buffer_sobra_3.php");
