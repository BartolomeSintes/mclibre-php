<?php
$buffer = 100;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>\n";
print "<p><a href=\"buffer-sobra-1.php\">Volver al principio</a></p>\n";
header("Location:buffer-sobra-3.php");
