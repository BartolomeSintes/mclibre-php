<?php
/**
 * Multiplicar 1-2 - multiplicar-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-10-27
 * @link      http://www.mclibre.org
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Multiplicar 1 (Resultado). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style type="text/css">table { text-align: right; }</style>
</head>

<body>
<h1>Multiplicar 1 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$respuesta = recoge("respuesta");
$a         = recoge("a");
$b         = recoge("b");

$respuestaOk = false;
$aOk         = false;
$bOk         = false;

if ($respuesta == "") {
    print "<p class=\"aviso\">No ha escrito una respuesta.</p>\n";
} elseif (!is_numeric($respuesta)) {
    print "<p class=\"aviso\">No ha escrito la respuesta como número.</p>\n";
} else {
    $respuestaOk = true;
}

if ($a == "" || !is_numeric($a) || !ctype_digit($a) || $a < 1 || $a > 9) {
    print "<p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $aOk = true;
}

if ($b == "" || !is_numeric($b) || !ctype_digit($b) || $b < 1 || $b > 9) {
    print "<p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $bOk = true;
}


if ($respuestaOk && $aOk && $bOk) {
    if ($a * $b == $respuesta) {
        print "<p>¡Respuesta correcta!</p>\n\n";
    } else {
        print "<p>¡Respuesta incorrecta!</p>\n\n";

        print "<p>La respuesta correcta no es $respuesta. La respuesta correcta es " . ($a * $b) . ".</p>\n\n";

        print "<table class=\"grande\">\n";
        print "  <tbody>\n";
        print "    <tr>\n";
        print "      <td></td>\n";
        print "      <td>$a</td>\n";
        print "    </tr>\n";
        print "    <tr>\n";
        print "      <td>X</td>\n";
        print "      <td>$b</td>\n";
        print "    </tr>\n";
        print "    <tr>\n";
        print "      <td colspan=\"2\" style=\"border-top: black 2px solid;\">"
            . ($a * $b) . "</td>\n";
        print "    </tr>\n";
        print "  </tbody>\n";
        print "</table>\n";
    }
}
?>

<p><a href="multiplicar-1-1.php">Volver al formulario.</a></p>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-10-27">27 de octubre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
