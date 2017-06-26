<?php
$buffer = 1;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>";
header("location:buffer_falta_3.php");
print "<p>La redirección <strong>no</strong> se ha realizado.</p>\n";
print "<p><a href=\"buffer_falta_1.php\">Volver al principio</a></p>\n";
