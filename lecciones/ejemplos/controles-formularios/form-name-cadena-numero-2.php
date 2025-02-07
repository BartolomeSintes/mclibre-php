<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    name cadena/número. Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
print "  <pre>\n";
print_r($_REQUEST);
print "\n";
foreach ($_REQUEST as $indice => $valor) {
    if (is_int($indice)) {
        print "El índice $indice es de tipo entero.\n";
    } elseif (is_string($indice)) {
        print "El índice $indice es de tipo cadena.\n";
    } else {
        print "El índice $indice no es de tipo entero ni cadena.\n";
    }
    if (is_int($valor)) {
        print "El valor $valor es de tipo entero.\n\n";
    } elseif (is_string($valor)) {
        print "El valor $valor es de tipo cadena.\n\n";
    } else {
        print "El valor $valor no es de tipo entero ni cadena.\n\n";
    }
}
print "\n";
print "<a href=\"form-name-cadena-numero-1.php\">Volver al formulario.</a>\n";
print "  </pre>";
print "\n";
?>
</body>
</html>
