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
