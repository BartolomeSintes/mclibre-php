<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    filter_var(). Comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

$dato = recoge("dato");

if ($dato == "") {
    print "  <p>No ha escrito nada.</p>\n";
    print "\n";
} elseif (filter_var($dato, FILTER_VALIDATE_INT)) {
    print "  <p>Ha escrito un número entero: <strong>$dato</strong>.</p>\n";
    print "\n";
} else {
    print "  <p>NO ha escrito un número entero: <strong>$dato</strong>.</p>\n";
    print "\n";
}
?>
  <p><a href="comprobacion-filter.html">Volver al formulario.</a></p>
</body>
</html>
