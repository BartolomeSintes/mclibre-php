<?php
$buffer = 1;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>";
header("location:buffer_0_3.php");
print "<p><a href=\"buffer_0_1.php\">Volver al principio</a></p>\n";
