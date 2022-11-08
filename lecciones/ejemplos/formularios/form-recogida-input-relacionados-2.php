<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Recogida inputs relacionados. Recogida de datos.
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
    print ($operacion == "suma") ? "<p>$x + $y = " . $x + $y . "</p>" : "";
    print ($operacion == "resta") ? "<p>$x - $y = " . $x - $y . "</p>" : "";
    print ($operacion == "multiplicacion") ? "<p>$x * $y = " . $x * $y . "</p>" : "";
    print ($operacion == "division") ? "<p>$x / $y = " . $x / $y . "</p>" : "";
}
?>

<p><a href="form-recogida-input-relacionados-1.php">Volver al formulario.</a></p>
</body>
</html>
