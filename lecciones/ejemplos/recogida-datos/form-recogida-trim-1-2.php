<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Eliminar espacios: trim (1). Recogida de datos.
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
if (trim($_REQUEST["nombre"]) == "") {
    print "  <p>No ha escrito ningún nombre</p>\n";
} else {
    print "  <p>Su nombre es " . trim($_REQUEST["nombre"]) . "</p>\n";
}
print "\n";
print "  <p><a href=\"form-recogida-trim-1-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
</body>
</html>
