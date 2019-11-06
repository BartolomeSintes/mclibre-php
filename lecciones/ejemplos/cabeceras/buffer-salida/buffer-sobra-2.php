<?php
$buffer = 200;
ob_start(null, $buffer);

print "<p>Esta es la página 2.</p>\n";
print "<p>Tamaño del buffer: $buffer</p>\n";

header("Location:buffer-sobra-3.php");

print "<p>La redirección <strong>NO</strong> se ha realizado.</p>\n";
print "<p><a href=\"buffer-sobra-1.php\">Volver al principio</a></p>\n";
