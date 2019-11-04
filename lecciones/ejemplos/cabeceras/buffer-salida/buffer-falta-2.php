<?php
$buffer = 1;
ob_start(null, $buffer);
print "<p>Tamaño del buffer: $buffer</p>";
header("Location:buffer-falta-3.php");
print "<p>La redirección <strong>NO</strong> se ha realizado.</p>\n";
print "<p><a href=\"buffer-falta-1.php\">Volver al principio</a></p>\n";
