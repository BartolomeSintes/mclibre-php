<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobación input number (1). Comprobación de datos.
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

// Variables que recogen los datos
$peso = recoge("peso");

// Variables auxiliares de comprobación
$pesoOk = false;

// Validación de datos y generación de avisos
if ($peso == "") {
    print "  <p class=\"aviso\">No ha escrito su peso.</p>\n";
    print "\n";
} elseif (!is_numeric($peso)) {
    print "  <p class=\"aviso\">No ha escrito su peso como número.</p>\n";
    print "\n";
} elseif ($peso < 40 || $peso > 150) {
    print "  <p class=\"aviso\">¿Está seguro de que su peso es $peso kg?</p>\n";
    print "\n";
} else {
    $pesoOk = true;
}

// Si todo es correcto, ejecución del programa
if ($pesoOk) {
    print "  <p>Su peso es <strong>$peso</strong> kg.</p>\n";
    print "\n";
}
?>

<p><a href="form-recogida-input-number-1-1.php">Volver al formulario.</a></p>
</body>
</html>
