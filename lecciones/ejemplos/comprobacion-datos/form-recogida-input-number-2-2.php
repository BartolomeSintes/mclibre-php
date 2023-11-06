<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobación input number (2). Comprobación de datos.
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

// Variables que recogen los datos
$edad = recoge("edad");

// Variables auxiliares de comprobación
$edadOk = false;

// Validación de datos y generación de avisos
if ($edad == "") {
    print "  <p class=\"aviso\">No ha escrito su edad.</p>\n";
    print "\n";
} elseif (!is_numeric($edad)) {
    print "  <p class=\"aviso\">No ha escrito su edad como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($edad)) {
    print "  <p class=\"aviso\">No ha escrito su edad como número entero positivo.</p>\n";
    print "\n";
} elseif ($edad < 5 || $edad > 120) {
    print "  <p class=\"aviso\">¿Está seguro de que su edad es $edad?</p>\n";
    print "\n";
} else {
    $edadOk = true;
}

// Si todo es correcto, ejecución del programa
if ($edadOk) {
    print "  <p>Su edad es <strong>$edad</strong> años.</p>\n";
    print "\n";
}
?>

<p><a href="form-recogida-input-number-2-1.php">Volver al formulario.</a></p>
</body>
</html>
