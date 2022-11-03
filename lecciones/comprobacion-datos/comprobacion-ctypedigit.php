<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    ctype_digit(). Comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

$dato = recoge("dato");

if ($dato == "") {
    print "  <p>No ha escrito nada.</p>\n";
    print "\n";
} elseif (ctype_digit($dato)) {
    print "  <p>Ha escrito un entero positivo: <strong>$dato</strong>.</p>\n";
    print "\n";
} else {
    print "  <p>NO ha escrito un entero positivo: <strong>$dato</strong>.</p>\n";
    print "\n";
}
?>
  <p><a href="comprobacion-ctypedigit.html">Volver al formulario.</a></p>
</body>
</html>
