<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>is_numeric(). Comprobación de datos. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$dato = recoge("dato");

if ($dato == "") {
    print "  <p>No ha escrito nada.</p>\n";
    print "\n";
} elseif (is_numeric($dato)) {
    print "  <p>Ha escrito un número: <strong>$dato</strong>.</p>\n";
    print "\n";
} else {
    print "  <p>NO ha escrito un número: <strong>$dato</strong>.</p>\n";
    print "\n";
}
?>
  <p><a href="comprobacion-isnumeric.html">Volver al formulario.</a></p>
</body>
</html>
