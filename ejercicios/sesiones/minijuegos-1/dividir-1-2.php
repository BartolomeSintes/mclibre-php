<?php
/**
 * Dividir 1-2 - dividir-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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
session_name("dividir-1");
session_start();

// Si algún número no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["a"]) || !isset($_SESSION["b"])) {
    header("Location:dividir-1-1.php");
    exit;
}

function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
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
    Minijuegos (1).
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
    $cocienteCorrecto = floor($_SESSION["a"] / $_SESSION["b"]);
    $restoCorrecto    = $_SESSION["a"] % $_SESSION["b"];
    if ($cociente == $cocienteCorrecto && $resto == $restoCorrecto) {
        print "  <p>¡Respuesta correcta!</p>\n";
        print "\n";
    } else {
        print "  <p class=\"aviso\">¡Respuesta incorrecta!</p>\n";
        print "\n";

        print "  <p>La respuesta correcta no es <strong>$cociente</strong> y <strong>$resto</strong>. "
            . "La respuesta correcta es <strong>$cocienteCorrecto</strong> y <strong>$restoCorrecto</strong>.</p>\n";
        print "\n";

        print "  <table class=\"grande derecha\">\n";
        print "    <tbody>\n";
        print "      <tr>\n";
        print "        <td>$_SESSION[a]</td>\n";
        print "        <td style=\"border-left: black 2px solid; border-bottom: black 2px solid;\">$_SESSION[b]</td>\n";
        print "      </tr>\n";
        print "      <tr>\n";
        print "        <td>$restoCorrecto</td>\n";
        print "        <td>$cocienteCorrecto</td>\n";
        print "      </tr>\n";
        print "    </tbody>\n";
        print "  </table>\n";
    }
}
?>

  <p><a href="dividir-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-31">31 de octubre de 2018</time>
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
