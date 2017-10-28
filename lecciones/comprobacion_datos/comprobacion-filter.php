<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>filter_var(). Comprobación de datos. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    print "    <p>No ha escrito nada.</p>\n";
} elseif (filter_var($dato, FILTER_VALIDATE_INT)) {
    print "    <p>Ha escrito un número entero: <strong>$dato</strong>.</p>\n";
} else {
    print "    <p>NO ha escrito un número entero: <strong>$dato</strong>.</p>\n";
}
?>

    <p><a href="comprobacion_filter.html">Volver al formulario.</a></p>
  </body>
</html>
