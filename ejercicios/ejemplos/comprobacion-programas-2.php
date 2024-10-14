<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    button submit (1). Controles en Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
$n = rand(1, 1000);

if ($n % 500 == 0) {
    print "  <p>$n es múltiplo de 500.</p>\n";
} else {
    print "  <p>$n no es múltiplo de 500.</p>\n";
}
?>
</body>
</html>
