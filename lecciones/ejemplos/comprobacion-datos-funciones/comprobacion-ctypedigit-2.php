<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    ctype_digit(). Funciones de comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
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

$dato = recoge("dato");

if ($dato == "") {
    print "  <p>No ha escrito nada.</p>\n";
    print "\n";
} elseif (!ctype_digit($dato)) {
    print "  <p>NO ha escrito un entero positivo: <strong>$dato</strong>.</p>\n";
    print "\n";
} else {
    print "  <p>Ha escrito un entero positivo: <strong>$dato</strong>.</p>\n";
    print "\n";
}
?>
  <p><a href="comprobacion-ctypedigit-1.php">Volver al formulario.</a></p>
</body>
</html>
