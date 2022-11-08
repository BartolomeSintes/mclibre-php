<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Recogida input number (2). Recogida de datos.
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
