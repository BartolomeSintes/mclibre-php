<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Función recoge() (dato escalar). Recogida de datos.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style> .aviso { color: red; }</style>
</head>

<body>
<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

// Variables que recogen los datos
$nombre   = recoge("nombre");
$apellidos = recoge("apellidos");

if ($nombre == "") {
    print "  <p>No ha escrito ningún nombre</p>\n";
    print "\n";
} else {
    print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
    print "\n";
}

if ($apellidos == "") {
    print "  <p>No ha escrito ningún apellido</p>\n";
    print "\n";
} else {
    print "  <p>Sus apellidos son <strong>$apellidos</strong>.</p>\n";
    print "\n";
}
?>
  <p><a href="recoge-escalar-1.php">Volver al formulario.</a></p>
</body>
</html>
