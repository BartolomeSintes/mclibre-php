<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Utilización de variables (2). Recogida de datos.
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

if (isset($_REQUEST["nombre"])) {
    $nombre = trim(strip_tags(htmlspecialchars($_REQUEST["nombre"])));
} else {
    $nombre = "";
}

if ($nombre == "") {
    print "  <p>No ha escrito ningún nombre</p>\n";
} else {
    print "  <p>Su nombre es $nombre</p>\n";
}
print "\n";
print "  <p><a href=\"form-recogida-variables-2-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
</body>
</html>
