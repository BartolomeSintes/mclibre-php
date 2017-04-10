<?php
$buffer = 100;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>\n";
print "<p><a href=\"buffer_1_1.php\">Volver al principio</a></p>\n";
header("location:buffer_1_3.php");
