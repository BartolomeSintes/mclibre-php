<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobación inputs relacionados. Comprobación de datos.
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
$operacion = recoge("operacion");
$x         = recoge("x");
$y         = recoge("y");

// Variables auxiliares de comprobación
$operacionOk = false;
$xOk         = false;
$yOk         = false;

// Validación de datos y generación de avisos
if ($operacion == "") {
    print "  <p class=\"aviso\">No ha indicado la operación a realizar.</p>\n";
    print "\n";
} elseif ($operacion != "suma" && $operacion != "resta" && $operacion != "multiplicacion" && $operacion != "division") {
    print "  <p class=\"aviso\">No ha elegido ninguna de las operaciones disponibles.</p>\n";
    print "\n";
} else {
    $operacionOk = true;
}

if ($x == "") {
    print "  <p class=\"aviso\">No ha escrito el primer número.</p>\n";
    print "\n";
} elseif (!is_numeric($x)) {
    print "  <p class=\"aviso\">No ha escrito el primer número como número.</p>\n";
    print "\n";
} else {
    $xOk = true;
}

if ($y == "") {
    print "  <p class=\"aviso\">No ha escrito el segundo número.</p>\n";
    print "\n";
} elseif (!is_numeric($y)) {
    print "  <p class=\"aviso\">No ha escrito el segundo número como número.</p>\n";
    print "\n";
} else {
    $yOk = true;
}

if ($operacion == "division" && $y == 0) {
    print "  <p class=\"aviso\">No se puede dividir por cero.</p>\n";
    print "\n";
    $operacionOk = false;
}

// Si todo es correcto, ejecución del programa
if ($operacionOk && $xOk && $yOk) {
    print ($operacion == "suma") ? "  <p>$x + $y = " . $x + $y . "</p>\n" : "";
    print ($operacion == "resta") ? "  <p>$x - $y = " . $x - $y . "</p>\n" : "";
    print ($operacion == "multiplicacion") ? "  <p>$x * $y = " . $x * $y . "</p>\n" : "";
    print ($operacion == "division") ? "  <p>$x / $y = " . $x / $y . "</p>\n" : "";
    print "\n";
}
?>
  <p><a href="form-recogida-input-relacionados-1.php">Volver al formulario.</a></p>
</body>
</html>
