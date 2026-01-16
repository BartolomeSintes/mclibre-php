<?php
/**
 * Dividir 1-2 - dividir-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
 * @link      https://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Accedemos a la sesión
session_name("dividir-1");
session_start();

// Si algún número no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["a"]) || !isset($_SESSION["b"])) {
    header("Location:dividir-1-1.php");
    exit;
}

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

$cociente    = recoge("cociente");
$resto       = recoge("resto");
$respuestaOk = false;

if ($cociente == "" || !is_numeric($cociente) || $resto == "" || !is_numeric($resto)) {
    header("Location:dividir-1-1.php");
    exit;
} else {
    $respuestaOk = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Dividir 1 (Resultado).
    Minijuegos (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>table { text-align: right; }</style>
</head>

<body>
  <h1>Dividir 1 (Resultado)</h1>

<?php
if ($respuestaOk) {
    $cocienteCorrecto = intdiv($_SESSION["a"], $_SESSION["b"]);
    $restoCorrecto    = $_SESSION["a"] % $_SESSION["b"];
    if ($cociente == $cocienteCorrecto && $resto == $restoCorrecto) {
        print "  <p>¡Respuesta correcta!</p>\n";
        print "\n";
    } else {
        print "  <p class=\"aviso\">¡Respuesta incorrecta!</p>\n";
        print "\n";

        print "  <p>\n";
        print "    La respuesta correcta no es <strong>$cociente</strong> y <strong>$resto</strong>.\n";
        print "    La respuesta correcta es <strong>$cocienteCorrecto</strong> y <strong>$restoCorrecto</strong>.\n";
        print "  </p>\n";
        print "\n";

        print "  <table class=\"grande derecha\">\n";
        print "    <tr>\n";
        print "      <td>$_SESSION[a]</td>\n";
        print "      <td style=\"border-left: black 2px solid; border-bottom: black 2px solid;\">$_SESSION[b]</td>\n";
        print "    </tr>\n";
        print "    <tr>\n";
        print "      <td>$restoCorrecto</td>\n";
        print "      <td>$cocienteCorrecto</td>\n";
        print "    </tr>\n";
        print "  </table>\n";
        print "\n";
    }
}
?>
  <p><a href="dividir-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
