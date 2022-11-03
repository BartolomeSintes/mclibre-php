<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Recogida input number (1). Recogida de datos.
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
