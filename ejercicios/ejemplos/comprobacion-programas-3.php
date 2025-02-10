<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ejemplo de comprobación de programas (3).
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
$n = rand(1, 1000);
$n = 500;

if ($n % 500 == 0) {
    print "  <p>$n es múltiplo de 500.</p>\n";
} else {
    print "  <p>$n no es múltiplo de 500.</p>\n";
}
?>
</body>
</html>
