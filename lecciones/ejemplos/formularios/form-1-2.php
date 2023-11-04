<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    form (1). Formularios.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style> h1 { margin: 0; }</style>
</head>

<body>
<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type != "" && $type != []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
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

$nombre = recoge("nombre");
$curso = recoge("curso");

print "  <h1>Resultado</h1>\n";
print "\n";

if (!$nombre) {
    print "  <p>No ha escrito su nombre</p>\n";
} else {
    print "  <p>¡Hola, $nombre!</p>\n";
}
print "\n";

if ($curso != "Primero" && $curso != "Segundo") {
    print "  <p>No ha indicado el curso que estudia.</p>\n";
} else {
    print "  <p>Estudia $curso.</p>\n";
}
print "\n";
?>
  <p><a href="form-1-1.php">Volver al formulario.</a></p>
</body>
</html>
