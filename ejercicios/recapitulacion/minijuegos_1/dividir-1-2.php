<?php
/**
 * Dividir 1-2 - dividir-1-2.php
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
  <title>Dividir 1 (Resultado). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style type="text/css">table { text-align: right; }</style>
</head>

<body>
<h1>Dividir 1 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$cociente = recoge("cociente");
$resto    = recoge("resto");
$a        = recoge("a");
$b        = recoge("b");

$cocienteOk = false;
$restoOk    = false;
$aOk        = false;
$bOk        = false;

if ($cociente == "") {
    print "<p class=\"aviso\">No ha escrito el cociente.</p>\n";
} elseif (!is_numeric($cociente)) {
    print "<p class=\"aviso\">No ha escrito el cociente como número.</p>\n";
} else {
    $cocienteOk = true;
}

if ($resto == "") {
    print "<p class=\"aviso\">No ha escrito el resto.</p>\n";
} elseif (!is_numeric($resto)) {
    print "<p class=\"aviso\">No ha escrito el resto como número.</p>\n";
} else {
    $restoOk = true;
}

if ($a == "" || !is_numeric($a) || !ctype_digit($a) || $a < 10 || $a > 99) {
    print "<p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $aOk = true;
}

if ($b == "" || !is_numeric($b) || !ctype_digit($b) || $b < 1 || $b > 9) {
    print "<p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $bOk = true;
}


if ($cocienteOk && $restoOk && $aOk && $bOk) {
    if ($a == $b * $cociente + $resto) {
        print "<p>¡Respuesta correcta!</p>\n\n";
    } else {
        print "<p>¡Respuesta incorrecta!</p>\n\n";

        print "<p>La respuesta correcta no es $cociente y $resto. La respuesta correcta es " . (floor($a / $b)) . " y " . ($a % $b). ".</p>\n\n";

        print "<table class=\"grande derecha\">\n";
        print "  <tbody>\n";
        print "    <tr>\n";
        print "      <td>$a</td>\n";
        print "      <td style=\"border-left: black 2px solid; border-bottom: black 2px solid;\">$b</td>\n";
        print "    </tr>\n";
        print "    <tr>\n";
        print "      <td>" . ($a % $b). "</td>\n";
        print "      <td>" . (floor($a / $b)) . "</td>\n";
        print "    </tr>\n";
        print "  </tbody>\n";
        print "</table>\n";

    }
}
?>

<p><a href="dividir-1-1.php">Volver al formulario.</a></p>

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
