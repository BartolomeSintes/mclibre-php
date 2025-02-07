<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Comprobación input checkbox. Comprobación de datos.
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
$python = recoge("python");
$php    = recoge("php");

// Variables auxiliares de comprobación
$pythonOk = false;
$phpOk    = false;

// Validación de datos y generación de avisos
if ($python != "Py" && $python != "") {
    print "  <p class=\"aviso\">Por favor, indique si sabe programar o no en Python.</p>\n";
    print "\n";
} else {
    $pythonOk = true;
}

if ($php != "PHP" && $php != "") {
    print "  <p class=\"aviso\">Por favor, indique si sabe programar o no en PHP.</p>\n";
    print "\n";
} else {
    $phpOk = true;
}

// Si todo es correcto, ejecución del programa
if ($pythonOk && $phpOk) {
    if ($python && $php) {
        print "  <p>Sabe programar en Python y en PHP.</p>\n";
        print "\n";
    } elseif ($python && !$php) {
        print "  <p>Sabe programar en Python, pero no en PHP.</p>\n";
        print "\n";
    } elseif (!$python && $php) {
        print "  <p>Sabe programar en PHP, pero no en Python.</p>\n";
        print "\n";
    } else {
        print "  <p>No sabe programar ni en Python ni en PHP.</p>\n";
        print "\n";
    }
}
?>
  <p><a href="form-recogida-input-checkbox-1.php">Volver al formulario.</a></p>
</body>
</html>
