<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Recogida input radio. Recogida de datos.
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
$gusta = recoge("gusta");

// Variables auxiliares de comprobación
$gustaOk = false;

// Validación de datos y generación de avisos
if ($gusta == "") {
    print "  <p class=\"aviso\">No ha indicado si le gusta el formulario.</p>\n";
    print "\n";
} elseif ($gusta != "Sí" && $gusta != "No") {
    print "  <p class=\"aviso\">No ha elegido ninguna de las opciones disponibles.</p>\n";
    print "\n";
} else {
    $gustaOk = true;
}

// Si todo es correcto, ejecución del programa
if ($gustaOk) {
    print "  <p><strong>$gusta</strong> le gusta este formulario.</p>\n";
    print "\n";
}
?>

<p><a href="form-recogida-input-radio-1.php">Volver al formulario.</a></p>
</body>
</html>
