<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Salida de datos: htmlspecialchars (4). Recogida de datos.
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

$nombre = (isset($_REQUEST["nombre"]))
    ? trim(htmlspecialchars($_REQUEST["nombre"]))
    : "";

if ($nombre == "") {
    print "  <p>No ha escrito ningún nombre</p>\n";
} else {
    print "  <p>Corrija: <input type=\"text\" value=\"$nombre\" size=\"35\"></p>\n";
}
print "\n";
print "  <p><a href=\"form-recogida-salida-htmlspecialchars-4-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
</body>
</html>
