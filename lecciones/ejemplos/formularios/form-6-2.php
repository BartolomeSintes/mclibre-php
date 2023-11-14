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
print "<pre>";
print_r($_REQUEST);
print "</pre>\n";
print "\n";

foreach($_REQUEST as $indice => $valor) {
    print "<p>El índice $indice es de tipo <strong>" . gettype($indice) . "</strong>. El valor $valor es de tipo <strong>" . gettype($valor) . "</strong>,</p>\n";
    print "\n";
}
?>

  <p><a href="form-6-1.php">Volver al formulario.</a></p>
</body>
</html>
