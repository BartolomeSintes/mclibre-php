<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    form (6). Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
print "  <pre>\n";
print_r($_REQUEST);
print "</pre>\n";
print "\n";

foreach ($_REQUEST as $indice => $valor) {
    if (is_array($valor)) {
        print "  <p>El índice <strong>$indice</strong> es de tipo <strong>" . gettype($indice) . "</strong>. El valor es de tipo <strong>" . gettype($valor) . "</strong>,</p>\n";
        print "\n";
    } else {
        print "  <p>El índice <strong>$indice</strong> es de tipo <strong>" . gettype($indice) . "</strong>. El valor <strong>$valor</strong> es de tipo <strong>" . gettype($valor) . "</strong>,</p>\n";
        print "\n";
    }
}
?>
  <p><a href="form-6-1.php">Volver al formulario.</a></p>
</body>
</html>
