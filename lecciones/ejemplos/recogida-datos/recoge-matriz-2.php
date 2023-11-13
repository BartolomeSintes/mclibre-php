<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Función recoge() (dato matriz). Recogida de datos.
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

// Variable que recoge los datos
$apellidos = recoge("apellidos", []);

if ($apellidos[1] == "") {
    print "<p>No ha escrito su primer apellido</p>";
} else {
    print "<p>Su primer apellido es <strong>$apellidos[1]</strong>.</p>\n";
}

if ($apellidos[2] == "") {
    print "<p>No ha escrito su segundo apellido</p>";
} else {
    print "<p>Su segundo apellido es <strong>$apellidos[2]</strong>.</p>\n";
}
?>

<p><a href="recoge-matriz-1.php">Volver al formulario.</a></p>
</body>
</html>
