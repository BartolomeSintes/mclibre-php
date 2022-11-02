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
// FUNCIÓN DE RECOGIDA DE DATOS
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

if ($curso != "1º" && $curso != "2º") {
    print "  <p>No ha indicado el curso que estudia.</p>\n";
} else {
    print "  <p>Estudia $curso.</p>\n";
}
print "\n";
?>
  <p><a href="form-1-1.php">Volver al formulario.</a></p>

</body>
</html>
