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

// Variables que recogen los datos
$nombre   = recoge("nombre", []);

if ($nombre[1] == "") {
    print "<p>No ha escrito ningún nombre</p>";
} else {
    print "<p>Su nombre es <strong>$nombre[1]</strong>.</p>\n";
}

if ($nombre[2] == "") {
    print "<p>No ha escrito ningún apellido</p>";
} else {
    print "<p>Sus apellidos son <strong>$nombre[2]</strong>.</p>\n";
}
?>

<p><a href="recoge-matriz-1.php">Volver al formulario.</a></p>
</body>
</html>
