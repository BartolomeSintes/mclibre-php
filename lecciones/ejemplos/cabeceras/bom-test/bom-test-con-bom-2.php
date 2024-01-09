<?php
$buffer = 1;
ob_start(null, $buffer);
header("Location:bom-test-con-bom-3.php");
print "<p>Esta es la página 2.</p>\n";
print "<p>La redirección <strong>NO</strong> se ha realizado.</p>\n";
print "<p><a href=\"bom-test-con-bom-1.php\">Volver al principio</a></p>\n";
